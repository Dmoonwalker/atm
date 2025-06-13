@props(['shops'])

<div>
    <x-import-products-modal :shops="$shops" />

    <div class="mt-6 space-y-6">
        <div>
            <x-input-label for="import" value="Import Products from 2Chat" />
            <div class="mt-2">
                <x-secondary-button type="button" @click="$dispatch('open-modal')">
                    Import Products
                </x-secondary-button>
            </div>
            <p class="mt-2 text-sm text-gray-500">
                Import your products from your WhatsApp Business catalog using your phone number.
            </p>
            @error('import')
            <x-input-error class="mt-2" :messages="$errors->get('import')" />
            @enderror
        </div>
    </div>
</div>