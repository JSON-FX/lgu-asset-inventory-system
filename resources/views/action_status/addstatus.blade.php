<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Add Category Form -->
                    <h1 class="text-xl font-semibold mb-4">Add New Status</h1>

                    <form action="{{ route('status.store') }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf

                        <!-- Category Name -->
                        <div class="mb-4">
                            <label for="status_name" class="block text-sm font-medium text-white">Status Name</label>
                            <input type="text" id="status_name" name="status_name" value="{{ old('status_name') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('status_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>



                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end">
                            <x-primary-button type="submit">Add  Status</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>