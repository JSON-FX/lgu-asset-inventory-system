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

                    <!-- Edit Asset Form -->
                    <h1 class="text-xl font-semibold mt-8 mb-4">Edit Asset</h1>
                    <form action="{{ route('assetlist.update', $property->id) }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf
                        @method('PUT')

                        <!-- Property Number -->
                        <div class="mb-4">
                            <label for="property_number" class="block text-sm font-medium text-white">Property Number</label>
                            <input type="text" id="property_number" name="property_number" value="{{ old('property_number', $property->property_number) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('property_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-white">Description</label>
                            <input type="text" id="description" name="description" value="{{ old('description', $property->description) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date of Purchase -->
                        <div class="mb-4">
                            <label for="date_purchase" class="block text-sm font-medium text-white">Date of Purchase</label>
                            <input type="date" id="date_purchase" name="date_purchase" value="{{ old('date_purchase', $property->date_purchase) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('date_purchase')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Serial Number -->
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-white">Serial Number</label>
                            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number', $property->serial_number) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('serial_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Office Dropdown -->
                        <div class="mb-4">
                            <label for="employee_id" class="block text-sm font-medium text-white">Office</label>
                            <select id="office_id" name="office_id" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @foreach($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id', $property->office_id) == $office->id ? 'selected' : '' }}>
                                        {{ $office->office_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('office_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status Dropdown -->
                        <div class="mb-4">
                            <label for="status_id" class="block text-sm font-medium text-white">Status</label>
                            <select id="status_id" name="status_id" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id', $property->status_id) == $status->id ? 'selected' : '' }}>
                                        {{ $status->status_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category Dropdown -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-white">Category</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Accountable Person Dropdown -->
                        <div class="mb-4">
                            <label for="employee_id" class="block text-sm font-medium text-white">Accountable Person</label>
                            <select id="employee_id" name="employee_id" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id', $property->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->employee_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Acquisition Cost -->
                        <div class="mb-4">
                            <label for="acquisition_cost" class="block text-sm font-medium text-white">Acquisition Cost</label>
                            <input type="number" step="0.01" id="acquisition_cost" name="acquisition_cost" value="{{ old('acquisition_cost', $property->acquisition_cost) }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('acquisition_cost')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Inventory Remarks -->
                        <div class="mb-4">
                            <label for="inventory_remarks" class="block text-sm font-medium text-white">Inventory Remarks</label>
                            <textarea id="inventory_remarks" name="inventory_remarks" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">{{ old('inventory_remarks', $property->inventory_remarks) }}</textarea>
                            @error('inventory_remarks')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6 flex justify-end">
                            <x-primary-button type="submit">Update Asset</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
