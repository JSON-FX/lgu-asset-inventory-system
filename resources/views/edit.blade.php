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

                    <!-- Page Title -->
                    <h1 class="text-xl font-semibold mb-4">Edit Asset</h1>

                    <!-- Success message after update -->
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Edit form -->
                    <form action="{{ route('asset.update', $property->id) }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf
                        @method('PUT') <!-- Correct method for update -->

                        <!-- Property Number & Description -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="property_number" class="block text-sm font-medium text-white">Property Number</label>
                                <input type="text" id="property_number" name="property_number" value="{{ old('property_number', $property->property_number) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @error('property_number')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-white">Description</label>
                                <input type="text" id="description" name="description" value="{{ old('description', $property->description) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Additional fields like Serial Number, Office, Date of Purchase, etc. -->
                            <div>
                                <label for="serial_number" class="block text-sm font-medium text-white">Serial Number</label>
                                <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number', $property->serial_number) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                                @error('serial_number')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="office" class="block text-sm font-medium text-white">Office</label>
                                <input type="text" id="office" name="office" value="{{ old('office', $property->office) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @error('office')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="date_purchase" class="block text-sm font-medium text-white">Date of Purchase</label>
                                <input type="date" id="date_purchase" name="date_purchase" value="{{ old('date_purchase', $property->date_purchase) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                                @error('date_purchase')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="accountable_person" class="block text-sm font-medium text-white">Accountable Person</label>
                                <input type="text" id="accountable_person" name="accountable_person" value="{{ old('accountable_person', $property->accountable_person) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                                @error('accountable_person')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="acquisition_cost" class="block text-sm font-medium text-white">Acquisition Cost</label>
                                <input type="number" step="0.01" id="acquisition_cost" name="acquisition_cost" value="{{ old('acquisition_cost', $property->acquisition_cost) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                                @error('acquisition_cost')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-white">Status</label>
                                <input type="text" id="status" name="status" value="{{ old('status', $property->status) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                                @error('status')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="inventory_remarks" class="block text-sm font-medium text-white">Inventory Remarks</label>
                                <textarea id="inventory_remarks" name="inventory_remarks" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">{{ old('inventory_remarks', $property->inventory_remarks) }}</textarea>
                                @error('inventory_remarks')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-2 flex justify-end mt-6">
                                <x-primary-button type="submit">Update Asset</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
