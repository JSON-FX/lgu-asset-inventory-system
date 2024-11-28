<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Asset Preview -->
                    <h1 class="text-xl font-semibold mb-4">Asset Preview</h1>
                    <div class="bg-gray-800 p-6 rounded-lg text-white">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <strong>QR Code:</strong>
                                <div class="mt-2">
                                    {!! QrCode::size(200)->generate($property->property_number) !!}
                                </div>
                            </div>
                            <!-- Original Property Number Display -->
                            <div><strong>Property Number:</strong> {{ $property->property_number }}</div>

                            <!-- QR Code Display -->
                            

                            <div><strong>Description:</strong> {{ $property->description }}</div>
                            <div><strong>Date of Purchase:</strong> {{ $property->date_purchase }}</div>
                            <div><strong>Serial Number:</strong> {{ $property->serial_number }}</div>
                            <div><strong>Office:</strong> {{ $offices->find($property->office_id)?->office_name }}</div>
                            <div><strong>Status:</strong> {{ $statuses->find($property->status_id)?->status_name }}</div>
                            <div><strong>Category:</strong> {{ $categories->find($property->category_id)?->category_name }}</div>
                            <div><strong>Accountable Person:</strong> {{ $employees->find($property->employee_id)?->employee_name }}</div>
                            <div><strong>Acquisition Cost:</strong> {{ number_format($property->acquisition_cost, 2) }}</div>
                            <div><strong>Inventory Remarks:</strong> {{ $property->inventory_remarks }}</div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>
