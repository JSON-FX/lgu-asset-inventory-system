<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Office') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Flex container to align the heading and button side by side -->
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl font-semibold">Office List</h1>
                        <!-- Button aligned to the right of the heading -->
                        <a href="{{ route('asset.create') }}">
                            <x-primary-button>
                                {{ __('Add Office') }}
                            </x-primary-button>
                        </a>
                    </div>

                    <!-- Make table scrollable on small screens -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Office Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($office as $office)
                                    <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                        <td class="px-4 py-2">{{ $office->id }}</td>
                                        <td class="px-4 py-2">{{ $office->office_name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-2 text-center">No office found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>