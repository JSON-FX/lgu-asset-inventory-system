@extends('layouts.master')
@section('title') @lang('translation.Add_Product') @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title') Add Asset @endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Basic Information</h4>
                <p class="card-title-desc">Fill all information below</p>
            </div>
            <div class="card-body">
                <form action="{{ route('asset.store') }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="property_number">Property Number</label>
                                <input id="property_number" name="property_number" type="text" class="form-control" placeholder="Property Number" value="{{ old('property_number') }}">
                                @error('property_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="1" placeholder="Asset Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="serial_number">Serial Number</label>
                                <input id="serial_number" name="serial_number" type="text" class="form-control" placeholder="Serial Number" value="{{ old('serial_number') }}">
                                @error('serial_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="purchase_date">Date Purchased</label>
                                <input id="purchase_date" name="purchase_date" type="date" class="form-control" placeholder="Acquisition Cost" value="{{ old('purchase_date') }}">
                                @error('purchase_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="acquisition_cost">Acquisition Cost</label>
                                <input id="acquisition_cost" name="acquisition_cost" type="number" class="form-control" placeholder="Acquisition Cost" value="{{ old('acquisition_cost') }}">
                                @error('acquisition_cost')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="control-label">Category</label>
                                <select class="form-control select2" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Office</label>
                                <select class="form-control select2" name="office_id">
                                    <option value="">Select</option>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                            {{ $office->office_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('office_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="control-label">User</label>
                                <select class="form-control select2" name="user_id">
                                    <option value="">Select</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('user_id') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->employee_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Status</label>
                                <select class="form-control select2" name="status_id">
                                    <option value="">Select</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                            {{ $status->status_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inventory_remarks">Inventory Remarks</label>
                                <textarea class="form-control" id="inventory_remarks" name="inventory_remarks" rows="5" placeholder="Remarks">{{ old('inventory_remarks') }}</textarea>
                                @error('inventory_remarks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Asset</button>
                        <button type="reset" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
