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
                        <table  class="min-w-full table-auto">
                            <thead>
                                <tr> 
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Property No.</th>
                                    <th class="px-4 py-2 text-left">Description</th>
                                    <th class="px-4 py-2 text-left">Serial No.</th>
                                    <th class="px-4 py-2 text-left">Office</th>
                                    <th class="px-4 py-2 text-left">Date of Purchase</th>
                                    <th class="px-4 py-2 text-left">Accountable Person</th>
                                    <th class="px-4 py-2 text-left">Acquisition Cost</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Inventory Remarks</th>
                                    <th class="px-4 py-2 text-left">Actions</th> <!-- Add Actions column -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($properties as $property)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200">
                                        <td class="px-4 py-2 ">{{ $property->id }}</td>
                                        <td class="px-4 py-2">{{ $property->property_number }}</td>
                                        <td class="px-4 py-2">{{ $property->description }}</td>
                                        <td class="px-4 py-2">{{ $property->serial_number }}</td>
                                        <td class="px-4 py-2">{{ $property->office }}</td>
                                        <td class="px-4 py-2">{{ $property->date_purchase }}</td>
                                        <td class="px-4 py-2">{{ $property->accountable_person }}</td>
                                        <td class="px-4 py-2">{{ number_format($property->acquisition_cost, 2) }}</td>
                                        <td class="px-4 py-2">{{ $property->status }}</td>
                                        <td class="px-4 py-2">{{ $property->inventory_remarks }}</td>
                                        <td class="px-4 py-2">
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
