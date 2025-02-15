<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Page Title -->
                    <h1 class="text-xl font-semibold mb-4">Edit Account</h1>

                    <!-- Success message after update -->
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Edit form -->
                    <form action="{{ route('account.update', $account->id) }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf
                        @method('PUT') <!-- Correct method for update -->

                        <!-- Property Number & Description -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="account_name" class="block text-sm font-medium text-white">Account Name</label>
                                <input type="text" id="account_name" name="account_name" value="{{ old('account_name', $account->account_name) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @error('account_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-2 flex justify-end mt-6">
                                <x-primary-button type="submit">Update Account</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
