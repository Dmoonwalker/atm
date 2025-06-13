<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        Log::info('Profile edit page accessed', [
            'user_id' => $request->user()->id,
            'user_email' => $request->user()->email
        ]);

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        Log::info('Profile update started', [
            'user_id' => $request->user()->id,
            'request_data' => $request->except(['password', 'current_password', 'password_confirmation'])
        ]);

        try {
            // Get only the allowed fields from the validated data
            $validatedData = $request->validated();

            // Remove name and email from the data to ensure they can't be updated
            unset($validatedData['name'], $validatedData['email']);

            // Fill only the allowed fields
            $request->user()->fill($validatedData);

            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                Log::info('Profile photo upload detected', [
                    'user_id' => $request->user()->id,
                    'file_name' => $request->file('profile_photo')->getClientOriginalName(),
                    'file_size' => $request->file('profile_photo')->getSize()
                ]);

                // Delete old profile photo if exists
                if ($request->user()->profile_photo) {
                    Log::info('Deleting old profile photo', [
                        'user_id' => $request->user()->id,
                        'old_photo_path' => $request->user()->profile_photo
                    ]);
                    Storage::delete($request->user()->profile_photo);
                }

                // Store new profile photo
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $request->user()->profile_photo = $path;

                Log::info('New profile photo stored', [
                    'user_id' => $request->user()->id,
                    'new_photo_path' => $path
                ]);
            }

            $request->user()->save();

            Log::info('Profile updated successfully', [
                'user_id' => $request->user()->id,
                'updated_fields' => array_keys($validatedData)
            ]);

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            Log::error('Profile update failed', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return Redirect::route('profile.edit')
                ->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info('Account deletion requested', [
            'user_id' => $request->user()->id
        ]);

        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            // Delete profile photo if exists
            if ($user->profile_photo) {
                Log::info('Deleting profile photo during account deletion', [
                    'user_id' => $user->id,
                    'photo_path' => $user->profile_photo
                ]);
                Storage::delete($user->profile_photo);
            }

            Auth::logout();

            $user->delete();

            Log::info('Account deleted successfully', [
                'user_id' => $user->id
            ]);

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } catch (\Exception $e) {
            Log::error('Account deletion failed', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to delete account: ' . $e->getMessage());
        }
    }

    public function importProducts(Request $request)
    {
        Log::info('Product import requested', [
            'user_id' => $request->user()->id,
            'user_phone' => $request->user()->phone,
            'request_method' => $request->method(),
            'request_url' => $request->fullUrl(),
            'request_headers' => $request->headers->all()
        ]);

        try {
            $user = $request->user();

            // 1. Request Validation
            if (empty($user->phone)) {
                Log::warning('Product import failed: No phone number', [
                    'user_id' => $user->id,
                    'user_data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone
                    ]
                ]);
                return response()->json([
                    'success' => false,
                    'error' => 'Please add your phone number to your profile first.'
                ]);
            }

            // 2. Shop Authorization
            $shopId = $request->input('shop_id');
            if (!$shopId) {
                return response()->json([
                    'success' => false,
                    'error' => 'Please select a shop to import products to.'
                ]);
            }

            $shop = $user->shops()->find($shopId);
            if (!$shop) {
                Log::warning('Product import failed: Shop not found or unauthorized', [
                    'user_id' => $user->id,
                    'shop_id' => $shopId
                ]);
                return response()->json([
                    'success' => false,
                    'error' => 'Selected shop not found or you are not authorized to import products to it.'
                ]);
            }

            // 3. Call User model's import method with shop
            $result = $user->importProductsFromTwoChat($shop);

            // 4. Handle response
            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'imported_count' => $result['imported_count'],
                    'errors' => $result['errors'] ?? []
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => $result['error']
            ]);
        } catch (\Exception $e) {
            Log::error('Product import failed', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to import products: ' . $e->getMessage()
            ]);
        }
    }
}
