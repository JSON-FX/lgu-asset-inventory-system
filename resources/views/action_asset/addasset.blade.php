@extends('layouts.master')

@section('title') 
    @lang('Add Asset') 
@endsection

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
                    <h4 class="card-title">Asset Information</h4>
                    <p class="card-title-desc">Fill all information below</p>
                </div>
                <div class="card-body">
                    <!-- Start of Form -->
                    <form id="addAssetForm" action="{{ route('asset.store') }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="property_number">Property Number</label>
                                    <input id="property_number" name="property_number" type="text" class="form-control" placeholder="Property Number" value="{{ old('property_number', $asset->property_number ?? '') }}">
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
                                
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="control-label">User</label>
                                    <select class="form-control select2" name="employee_id">
                                        <option value="">Select</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
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
                                    <input id="date_purchase" name="date_purchase" type="date" class="form-control" value="{{ old('date_purchase') }}">
                                    @error('date_purchase')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="serial_number">Serial Number</label>
                                    <input id="serial_number" name="serial_number" type="text" class="form-control" placeholder="Scan Serial Number" value="{{ old('serial_number') }}" autofocus>
                                    @error('serial_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                                
                                <div class="mb-3">
                                    <label for="acquisition_cost">Acquisition Cost</label>
                                    <input id="acquisition_cost" name="acquisition_cost" type="number" class="form-control" value="{{ old('acquisition_cost') }}">
                                    @error('acquisition_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inventory_remarks">Inventory Remarks</label>
                                    <textarea class="form-control" id="inventory_remarks" name="inventory_remarks" rows="1" placeholder="Remarks">{{ old('inventory_remarks', $asset->inventory_remarks ?? '') }}</textarea>
                                    @error('inventory_remarks')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div>
                            <button type="button" id="addAssetButton"class="btn btn-primary">Save Asset</button>
                            <a href="{{ route('asset') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                        </div>
                    </form>
                    <!-- End of Form -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const serialNumberField = document.getElementById('serial_number');
        const addAssetModal = document.getElementById('addAssetModal');

        // Automatically focus the serial number field when the modal opens
        addAssetModal.addEventListener('shown.bs.modal', function () {
            serialNumberField.focus();
        });

        // Handle enter key or scanned input if scanner sends a newline
        serialNumberField.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent form submission (if inside a form)
                alert('Serial number scanned: ' + serialNumberField.value);
                // You can perform additional actions here, like validating the input.
            }
        });
    });

    </script>
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('addAssetButton').addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default button behavior

            // Display success alert after form submission
            Swal.fire({
                title: 'Success!',
                text: 'Asset has been added successfully.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then(() => {
                // Submit the form after showing the success alert
                document.getElementById('addAssetForm').submit();
            });
        });
    </script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
