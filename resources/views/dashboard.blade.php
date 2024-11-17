<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Existing fields... -->

                <!-- Asset Details -->
                <div class="mt-4">
                    <x-input-label for="asset_name" :value="__('Asset Name')" />
                    <x-text-input id="asset_name" class="block mt-1 w-full" type="text" name="asset_name" :value="old('asset_name')" required autofocus autocomplete="asset_name" />
                    <x-input-error :messages="$errors->get('asset_name')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    
</x-app-layout>
