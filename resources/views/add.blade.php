<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Add Asset Form -->
                    <h1 class="text-xl font-semibold mb-4">Add New Asset</h1>

                    <form action="{{ route('asset.store') }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf

                        <!-- Property Number -->
                        <div class="mb-4">
                            <label for="property_number" class="block text-sm font-medium text-white">Property Number</label>
                            <input type="text" id="property_number" name="property_number" value="{{ old('property_number') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('property_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-white">Description</label>
                            <input type="text" id="description" name="description" value="{{ old('description') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Serial Number -->
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-white">Serial Number</label>
                            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('serial_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Office -->
                        <div class="mb-4">
                            <label for="office" class="block text-sm font-medium text-white">Office</label>
                            <input type="text" id="office" name="office" value="{{ old('office') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('office')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date of Purchase -->
                        <div class="mb-4">
                            <label for="date_purchase" class="block text-sm font-medium text-white">Date of Purchase</label>
                            <input type="date" id="date_purchase" name="date_purchase" value="{{ old('date_purchase') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('date_purchase')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Accountable Person -->
                        <div class="mb-4">
                            <label for="accountable_person" class="block text-sm font-medium text-white">Accountable Person</label>
                            <input type="text" id="accountable_person" name="accountable_person" value="{{ old('accountable_person') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('accountable_person')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Acquisition Cost -->
                        <div class="mb-4">
                            <label for="acquisition_cost" class="block text-sm font-medium text-white">Acquisition Cost</label>
                            <input type="number" step="0.01" id="acquisition_cost" name="acquisition_cost" value="{{ old('acquisition_cost') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('acquisition_cost')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-white">Status</label>
                            <input type="text" id="status" name="status" value="{{ old('status') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Inventory Remarks -->
                        <div class="mb-4">
                            <label for="inventory_remarks" class="block text-sm font-medium text-white">Inventory Remarks</label>
                            <textarea id="inventory_remarks" name="inventory_remarks" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">{{ old('inventory_remarks') }}</textarea>
                            @error('inventory_remarks')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end">
                            <x-primary-button type="submit">Add Asset</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
