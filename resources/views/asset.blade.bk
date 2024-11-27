<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Flex container to align the heading and buttons side by side -->
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl font-semibold">Assets List</h1>
                        <!-- Buttons aligned to the right of the heading -->
                        <div>
                            <a href="{{ route('asset.export') }}">
                                <x-secondary-button>
                                    {{ __('Export to Excel') }}
                                </x-secondary-button>
                            </a>
                        </div>
                        
                        <!-- Add Asset button in its own div -->
                        <div>
                            <a href="{{ route('assetlist.create') }}">
                                <x-primary-button>
                                    {{ __('Add Asset') }}
                                </x-primary-button>
                            </a>
                        </div>

                    </div>

                    <!-- Make table scrollable on small screens -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                <tr>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">ID</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Property No.</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Description</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Serial No.</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Office</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Category</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Date of Purchase</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Accountable Person</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Acquisition Cost</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Status</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Inventory Remarks</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600 w-32">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300">
                                @forelse ($properties as $property)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200">
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->id }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->property_number }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->description }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->serial_number }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->office->office_name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->category->category_name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->date_purchase }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->employee->employee_name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">₱{{ number_format($property->acquisition_cost, 2) }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->status->status_name }} </td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->inventory_remarks }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600 text-center">
                                            <a href="{{ route('assetlist.editassetlist', $property->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="px-4 py-2 text-center">No assets found.</td>
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
