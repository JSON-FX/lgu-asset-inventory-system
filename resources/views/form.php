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

                        <!-- Date Purchase -->
                        <div class="mb-4">
                            <label for="date_purchase" class="block text-sm font-medium text-white">Date of Purchase</label>
                            <input type="date" id="date_purchase" name="date_purchase" value="{{ old('date_purchase') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                            @error('date_purchase')
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

                        <!-- Office Dropdown -->
                        <div class="mb-4">
                            <label for="office_id" class="block text-sm font-medium text-white">Office</label>
                            <select id="office_id" name="office_id" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md" required>
                                <option value="" disabled selected>Select an Office</option>
                                @foreach($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
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
                                <option value="" disabled selected>Select a Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
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
                                <option value="" disabled selected>Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <option value="" disabled selected>Select an Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
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
                            <input type="number" step="0.01" id="acquisition_cost" name="acquisition_cost" value="{{ old('acquisition_cost') }}" class="mt-1 block w-full bg-gray-800 text-white border-gray-600 rounded-md">
                            @error('acquisition_cost')
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
