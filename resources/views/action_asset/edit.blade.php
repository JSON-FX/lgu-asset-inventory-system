@extends('layouts.master')
@section('title') @lang('translation.Product_Detail') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title')Asset Detail @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="product-detai-imgs">
                            <div class="row">
                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                            <div>
                                                <div class="img-fluid mx-auto d-block">
                                                    {!! QrCode::size(225)->generate($property->property_number) !!}
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="mt-4 mt-xl-3">
                            
                            <h5 class="mt-1 mb-3">Propert Number</h5>
                            <p class="text-muted sm-4">{{ $property->property_number }}</p>
                            <h5 class="mt-1 mb-3">Serial Number</h5>
                            <p class="text-muted sm-4">{{ $property->serial_number }}</p>
                            <h5 class="mt-1 mb-3">Description</h5>
                            <p class="text-muted sm-4">{{ $property->description }}</p>
                            <h5 class="mt-1 mb-3">Category</h5>
                            <p class="text-muted sm-4">{{ $categories->find($property->category_id)?->category_name }}</p>
                            <h5 class="mt-1 mb-3">Office</h5>
                            <p class="text-muted sm-4">{{ $offices->find($property->office_id)?->office_name }}</p>    
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mt-4 mt-xl-3">    
                        <h5 class="mt-1 mb-3">Status</h5>
                            <p class="text-muted sm-4">{{ $statuses->find($property->status_id)?->status_name }}</p>
                            <h5 class="mt-1 mb-3">User</h5>
                            <p class="text-muted sm-4">{{ $employees->find($property->employee_id)?->employee_name }}</p>
                            <h5 class="mt-1 mb-3">Date Purchased</h5>
                            <p class="text-muted sm-4">{{ $property->date_purchase }}</p>
                            <h5 class="mt-1 mb-3">Acquisition Cost</h5>
                            <p class="text-muted sm-4">₱{{ number_format($property->acquisition_cost, 2) }}</p>
                            <h5 class="mt-1 mb-3">Inventory Remarks</h5>
                            <p class="text-muted sm-4">{{ $property->inventory_remarks }}</p>
                        </div>
                    </div>
                </div>
            </div>
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
                <!-- end row -->
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
