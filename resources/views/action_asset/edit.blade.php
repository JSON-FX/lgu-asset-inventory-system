@extends('layouts.master')
@section('title') @lang('Edit Asset') @endsection
@section('content')
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Asset Information</h4>
                        <p class="card-title-desc">Fill all information below</p>
                    </div>
                    <div class="card-body">
                        <!-- Start of Form -->
                        <form action="{{ route('assetlist.update', $property->id) }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="property_number">Property Number</label>
                                        <input id="property_number" name="property_number" type="text" class="form-control" placeholder="Property Number" value="{{ old('property_number', $property->property_number) }}">
                                        @error('property_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="1" placeholder="Asset Description">{{ old('description', $property->description) }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="control-label">Category</label>
                                        <select class="form-control select2" name="category_id">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
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
                                            <option value="{{ $office->id }}" {{ old('office_id', $property->office_id) == $office->id ? 'selected' : '' }}>
                                                    {{ $office->office_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('office_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="control-label">Status</label>
                                        <select class="form-control select2" name="status_id">
                                            <option value="">Select</option>
                                            @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('status_id', $property->status_id) == $status->id ? 'selected' : '' }}>
                                                    {{ $status->status_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="control-label">User</label>
                                        <select class="form-control select2" name="employee_id">
                                            <option value="">Select</option>
                                            @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id', $property->employee_id) == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->employee_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_purchase">Date Purchased</label>
                                        <input id="date_purchase" name="date_purchase" type="date" class="form-control" value="{{ old('date_purchase', $property->date_purchase ? $property->date_purchase->format('Y-m-d') : '') }}">
                                        @error('date_purchase')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="serial_number">Serial Number</label>
                                        <input id="serial_number" name="serial_number" type="text" class="form-control" placeholder="Serial Number" value="{{ old('serial_number', $property->serial_number) }}">
                                        @error('serial_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="acquisition_cost">Acquisition Cost</label>
                                        <input id="acquisition_cost" name="acquisition_cost" type="number" class="form-control" value="{{ old('acquisition_cost', $property->acquisition_cost) }}">
                                        @error('acquisition_cost')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inventory_remarks">Inventory Remarks</label>
                                        <textarea class="form-control" id="inventory_remarks" name="inventory_remarks" rows="1" placeholder="Remarks">{{ old('inventory_remarks', $property->inventory_remarks) }}</textarea>
                                        @error('inventory_remarks')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <!-- Submit and Reset Buttons -->
                            <div>
                                <button type="submit" class="btn btn-primary">Update Asset</button>
                                <a href="{{ route('asset') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                            </div>
                        </form>
                        <!-- End of Form -->
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>
@endsection
