<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Flex container to align the heading and button side by side -->
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl font-semibold">Category List</h1>
                        <!-- Button aligned to the right of the heading -->
                        <a href="{{ route('category.create') }}">
                            <x-primary-button>
                                {{ __('Add Category') }}
                            </x-primary-button>
                        </a>
                    </div>

                    <!-- Make table scrollable on small screens -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Category Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category as $category)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200">
                                        <td class="px-4 py-2">{{ $category->id }}</td>
                                        <td class="px-4 py-2">{{ $category->category_name }}</td>
                                        <td class="px-4 py-2">
                                            <!-- Edit button inside each row -->
                                            <a href="{{ route('category.editcategory', $category->id) }}" class="text-blue-500">
                                                Edit
                                            </a>
                                        </td>   
                                    </tr>
                                    
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-2 text-center">No category found.</td>
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