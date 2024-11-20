<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Flex container to align the heading and button side by side -->
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl font-semibold">Assets List</h1>
                        <!-- Button aligned to the right of the heading -->
                        <a href="{{ route('asset.create') }}">
                            <x-primary-button>
                                {{ __('Add Asset') }}
                            </x-primary-button>
                        </a>
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
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Date of Purchase</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Accountable Person</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Acquisition Cost</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Status</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Inventory Remarks</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600 w-32">Actions</th> <!-- Added fixed width for Actions column -->
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300">
                                @forelse ($properties as $property)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200">
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->id }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->property_number }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->description }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->serial_number }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->office }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->date_purchase }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->accountable_person }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">₱{{ number_format($property->acquisition_cost, 2) }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">
                                            <!-- Conditional color based on Status -->
                                            <span class="{{ $property->status === 'Active' ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $property->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->inventory_remarks }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600 text-center">
                                            <!-- Edit button inside each row -->
                                            <a href="{{ route('asset.edit', $property->id) }}" class="text-blue-500 hover:text-blue-700">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="px-4 py-2 text-center">No assets found.</td>
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
