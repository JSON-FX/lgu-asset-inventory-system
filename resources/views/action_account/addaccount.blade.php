<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Add Category Form -->
                    <h1 class="text-xl font-semibold mb-4">Add New Account</h1>

                    <form action="{{ route('status.store') }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf

                        <!-- Category Name -->
                        <div class="mb-4">
                            <label for="account_name" class="block text-sm font-medium text-white">Status Name</label>
                            <input type="text" id="account_name" name="account_name" value="{{ old('account_name') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('account_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>



                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end">
                            <x-primary-button type="submit">Add  Account</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
