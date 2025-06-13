<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create', [
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:bug,feature,complaint,suggestion,other',
        ]);

        // If user is logged in, associate the feedback with their account
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
            // Use user's name and email if not provided
            if (empty($validated['name'])) {
                $validated['name'] = Auth::user()->name;
            }
            if (empty($validated['email'])) {
                $validated['email'] = Auth::user()->email;
            }
        }

        Feedback::create($validated);

        return redirect()->route('feedback.create')
            ->with('status', 'Thank you for your feedback! We will review it shortly.');
    }

    public function index()
    {
        // Only show feedback for logged-in users
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $feedback = Feedback::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('feedback.index', [
            'feedback' => $feedback,
        ]);
    }
}
