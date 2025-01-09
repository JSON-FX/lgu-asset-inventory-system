

@extends('layouts.master')
@section('title') @lang('Asset List') @endsection
@section('css')
    <style>
        .select2-container--default .select2-dropdown {
            z-index: 1090 !important; /* Ensure it's higher than the modal */
        }
        .select2-container {
            z-index: 1090 !important; /* Ensure select2 container has higher priority */
        }
    </style>

    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet"> <!-- Load AlertifyJS CSS Last -->
@endsection 
@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title') Assets List @endslot
@endcomponent
@if(session('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000); // Hides the message after 5 seconds
    </script>
@endif

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3  text-end " >                     
                        <a href="{{ route('assetlist.create') }}" data-bs-toggle="modal" data-bs-target="#addAssetModal" class="btn btn-success"><i class="bx bx-plus me-1"></i> Add Asset</a>
                    </div>
                    <form action="{{ route('assetlist.index') }}" method="GET" id="filterForm">
                        <div class="row">
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full md:w-1/4 px-4 mb-4">
                                    <label for="acquisition_cost_filter" class="block text-sm font-medium mb-2">Item Cost</label>
                                    <select name="acquisition_cost_filter" id="acquisition_cost_filter" class="block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring focus:border-gray-500 sm:text-sm">
                                        <option value="">Select Option</option>
                                        <option value="above_50k" {{ request('acquisition_cost_filter') == 'above_50k' ? 'selected' : '' }}>Above 50,000</option>
                                        <option value="below_50k" {{ request('acquisition_cost_filter') == 'below_50k' ? 'selected' : '' }}>Below 50,000</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Qty</th>
                                <th>PR No.</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Office</th>
                                <th>Serial No.</th>
                                <th>Purchase date</th>
                                <th>Accountable</th>
                                <th>User</th>
                                <th>Acquisition cost</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->qty }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->property_number }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->description }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->category->category_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->office->office_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->serial_number }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ \Carbon\Carbon::parse($property->date_purchase)->format('m-d-Y') }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->employee2->employee_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->employee->employee_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">₱{{ number_format($property->acquisition_cost, 2) }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">
                                        @if ($property->status->status_name === 'Maintenance')
                                            <span class="badge badge-pill badge-soft-warning font-size-10">Maintenance</span>
                                        @elseif ($property->status->status_name === 'Serviceable')
                                            <span class="badge badge-pill badge-soft-success font-size-10">Serviceable</span>
                                        @elseif ($property->status->status_name === 'Unserviceable')
                                            <span class="badge badge-pill badge-soft-danger font-size-10">Unserviceable</span>
                                        @else
                                            <span class="badge badge-pill badge-soft-secondary font-size-10">{{ $property->status->status_name }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->inventory_remarks }}</td>
                                    
                                    <td>
                                        <div class="d-flex gap-3">
                                            <!-- Eye Icon to open the modal -->
                                            <a class="mdi mdi-eye font-size-18" data-bs-toggle="modal" data-bs-target="#orderdetailsModal-{{ $property->id }}"></a>
                                            <a href="{{ route('assetlist.editassetlist', $property->id) }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="javascript:void(0);" 
                                                class="text-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal-{{ $property->id }}">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                            
                                    </td>
                                </tr>
                                <!-- Modal for softdeletion confirmation -->
                                <div class="modal fade" id="deleteModal-{{ $property->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $property->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $property->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to move <strong>{{ $property->description }}</strong> to trash?
                                            </div>
                                            <div class="modal-footer">
                                                <!-- Form for deletion -->
                                                <form action="{{ route('assetlist.delete', $property->id) }}" method="GET">
                                                    @csrf
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="orderdetailsModal-{{ $property->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel-{{ $property->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="orderdetailsModalLabel-{{ $property->id }}">{{ $property->description }} details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Left Column: QR Code and Image -->
                                                    <div class="col-xl-4">
                                                        <div class="product-detai-imgs">
                                                            <div class="row">
                                                                <!-- QR Code Section -->
                                                                <div class="col-md-7 offset-md-1 col-sm-9 col-8 mt-4">
                                                                    <div class="tab-content" id="v-pills-tabContent">
                                                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                                                            <div>
                                                                                <div class="img-fluid mx-auto d-block">
                                                                                    {!! QrCode::size(180)->generate($property->property_number) !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Image Section -->
                                                                <div class="col-md-7 offset-md-1 col-sm-9 col-8 mt-4">
                                                                    <div class="tab-content" id="v-pills-tabContent">
                                                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                                                            <div>
                                                                                <div class="img-fluid mx-auto d-block">
                                                                                    <!-- Add link to view image in a new tab -->
                                                                                    <a href="{{ asset('storage/' . $property->image_path) }}" target="_blank">
                                                                                        <img 
                                                                                            src="{{ asset('storage/' . $property->image_path) }}" 
                                                                                            alt="Property Image" 
                                                                                            style="width: 180px; height: 180px; object-fit: cover;">
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    
                                
                                                    <!-- Middle Column: Property Details -->
                                                    <div class="col-xl-4">
                                                        <div class="mt-4 mt-xl-3">
                                                            <h5 class="mt-1 mb-3">Description</h5>
                                                            <p class="text-muted sm-4">{{ $property->description }}</p>
                                                            <h5 class="mt-1 mb-3">Property No.</h5>
                                                            <p class="text-muted sm-4">{{ $property->property_number }}</p>
                                                            
                                                            @if($property->elc_number || $property->engine_number)
                                                                <!-- If elc_number or engine_number is present, show these details instead of serial number -->
                                                                @if($property->elc_number)
                                                                    <h5 class="mt-1 mb-3">ELC Number</h5>
                                                                    <p class="text-muted sm-4">{{ $property->elc_number }}</p>
                                                                @endif
                                                                @if($property->chasis_number)
                                                                    <h5 class="mt-1 mb-3">Chassis Number</h5>
                                                                    <p class="text-muted sm-4">{{ $property->chasis_number }}</p>
                                                                @endif
                                                                @if($property->plate_number)
                                                                    <h5 class="mt-1 mb-3">Plate Number</h5>
                                                                    <p class="text-muted sm-4">{{ $property->plate_number }}</p>
                                                                @endif
                                                                @if($property->engine_number)
                                                                    <h5 class="mt-1 mb-3">Engine Number</h5>
                                                                    <p class="text-muted sm-4">{{ $property->engine_number }}</p>
                                                                @endif
                                                            @else
                                                                <!-- If no elc_number or engine_number, show serial number -->
                                                                <h5 class="mt-1 mb-3">Serial No.</h5>
                                                                <p class="text-muted sm-4">{{ $property->serial_number }}</p>
                                                            @endif
                                                            <h5 class="mt-1 mb-3">Account</h5>
                                                            <p class="text-muted sm-4">{{ $property->account->account_name }}</p>
                                                            
                                                            <h5 class="mt-1 mb-3">Category</h5>
                                                            <p class="text-muted sm-4">{{ $property->category->category_name }}</p>
                                                            <h5 class="mt-1 mb-3">Office</h5>
                                                            <p class="text-muted sm-4">{{ $property->office->office_name }}</p>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Right Column: More Details -->
                                                    <div class="col-xl-4">
                                                        <div class="mt-4 mt-xl-3">
                                                            <h5 class="mt-1 mb-3">Status</h5>
                                                            <p class="text-muted sm-4">{{ $property->status->status_name }}</p>
                                                            <h5 class="mt-1 mb-3">Accountable</h5>
                                                            <p class="text-muted sm-4">{{ $property->employee2->employee_name }}</p>
                                                            <h5 class="mt-1 mb-3">User</h5>
                                                            <p class="text-muted sm-4">{{ $property->employee->employee_name }}</p>
                                                            <h5 class="mt-1 mb-3">Date Purchased</h5>
                                                            <p class="text-muted sm-4">
                                                                {{ $property->date_purchase ? \Carbon\Carbon::parse($property->date_purchase)->format('F j, Y') : 'N/A' }}
                                                            </p>
                                                            <h5 class="mt-1 mb-3">Acquisition Cost</h5>
                                                            <p class="text-muted sm-4">{{ $property->acquisition_cost ? number_format($property->acquisition_cost, 2) : 'N/A' }}</p>
                                                    
                                                            <h5 class="mt-1 mb-3">Qty</h5>
                                                            <p class="text-muted sm-4">{{ number_format($property->qty) }}</p>
                                                    
                                                            <h5 class="mt-1 mb-3">Inventory Remarks</h5>
                                                            <p class="text-muted sm-4">{{ $property->inventory_remarks }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- Generate ICS button for acquisition_cost below 50,000 -->
                                                @if($property->acquisition_cost < 50000)
                                                    <a href="{{ route('property.export', $property->id) }}" class="btn btn-success">
                                                        Generate ICS
                                                    </a>
                                                @endif
                                            
                                                <!-- Generate PAR button for acquisition_cost above 50,000 -->
                                                @if($property->acquisition_cost >= 50000)
                                                    <a href="{{ route('property2.export', $property->id) }}" class="btn btn-success">
                                                        Generate PAR
                                                    </a>
                                                @endif
                                            
                                                <!-- Generate Sticker button always shown -->
                                                <a href="{{ route('asset.exportpdf', $property->id) }}" class="btn btn-danger">
                                                    Generate Sticker
                                                </a>
                                            
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- Add Asset Modal -->
        <div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="addAssetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAssetModalLabel">Add New Asset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Start of Form -->
                        <form id="addAssetForm" action="{{ route('asset.store') }}"method="POST" enctype="multipart/form-data" class="bg-gray-900 p-6 rounded-lg">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-sm-6">
                                    <!-- Property Number -->
                                    <div class="mb-3">
                                        <label for="property_number">Property Number</label>
                                        <input id="property_number" name="property_number" type="text" class="form-control" placeholder="Property Number" value="{{ old('property_number', $asset->property_number ?? '') }}">
                                        @error('property_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="1" placeholder="Asset Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Category -->
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
                                    <!-- Office -->
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
                                    <!-- Status -->
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
                                        <label class="control-label">Accountable</label>
                                        <select class="form-control select2" name="employee_id2">
                                            <option value="">Select</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('employee_id2') == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->employee_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_id2')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="control-label">Account</label>
                                        <select class="form-control select2" name="account_id">
                                            <option value="">Select</option>
                                            @foreach($accounts as $account)
                                                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                                    {{ $account->account_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('account_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-sm-6">
                                    <!-- User -->
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
                                    <!-- Date Purchased -->
                                    <div class="mb-3">
                                        <label for="date_purchase">Date Purchased</label>
                                        <input id="date_purchase" name="date_purchase" type="date" class="form-control" value="{{ old('date_purchase') }}">
                                        @error('date_purchase')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Serial Number -->
                                    <div class="mb-3">
                                        <label>Select Type</label><br>
                                        <input type="radio" id="engine_number_radio" name="number_type" value="engine" onchange="toggleFields()">
                                        <label for="engine_number_radio">Vehicle</label>
                                
                                        <input type="radio" id="serial_number_radio" name="number_type" value="serial" onchange="toggleFields()">
                                        <label for="serial_number_radio">Item</label>
                                    </div>
                                
                                    <!-- ENGINE Number Input Field (Initially hidden) -->
                                    <div id="engine_number_field" class="mb-3" style="display: none;">
                                        <label for="engine_number">ENGINE Number</label>
                                        <input id="engine_number" name="engine_number" type="text" class="form-control" placeholder="Scan Engine Number" value="{{ old('engine_number') }}" autofocus>
                                        @error('engine_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div id="elc_number_field" class="mb-3" style="display: none;">
                                        <label for="elc_number">ELC Number</label>
                                        <input id="elc_number" name="elc_number" type="text" class="form-control" placeholder="Enter ELC Number" value="{{ old('elc_number') }}">
                                        @error('elc_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                
                                    <!-- Plate Number Input Field (Initially hidden) -->
                                    <div id="plate_number_field" class="mb-3" style="display: none;">
                                        <label for="plate_number">Plate Number</label>
                                        <input id="plate_number" name="plate_number" type="text" class="form-control" placeholder="Enter Plate Number" value="{{ old('plate_number') }}">
                                        @error('plate_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Plate Number Input Field (Initially hidden) -->
                                    <div id="chasis_number_field" class="mb-3" style="display: none;">
                                        <label for="chasis_number">Chasis Number</label>
                                        <input id="chasis_number" name="chasis_number" type="text" class="form-control" placeholder="Enter Plate Number" value="{{ old('chasis_number') }}">
                                        @error('chasis_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                
                                    <!-- Serial Number Input Field (Initially visible) -->
                                    <div id="serial_number_field" class="mb-3">
                                        <label for="serial_number">Serial Number</label>
                                        <input id="serial_number" name="serial_number" type="text" class="form-control" placeholder="Scan Serial Number" value="{{ old('serial_number') }}" autofocus>
                                        @error('serial_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Acquisition Cost -->
                                    <div class="mb-3">
                                        <label for="acquisition_cost">Acquisition Cost</label>
                                        <input id="acquisition_cost" name="acquisition_cost" type="number" class="form-control" value="{{ old('acquisition_cost') }}">
                                        @error('acquisition_cost')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Acquisition Cost -->
                                    <div class="mb-3">
                                        <label for="qty">Quantity</label>
                                        <input id="qty" name="qty" type="number" class="form-control" value="{{ old('qty') }}">
                                        @error('qty')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Inventory Remarks -->
                                    <div class="mb-3">
                                        <label for="inventory_remarks">Inventory Remarks</label>
                                        <textarea class="form-control" id="inventory_remarks" name="inventory_remarks" rows="1" placeholder="Remarks">{{ old('inventory_remarks', $asset->inventory_remarks ?? '') }}</textarea>
                                        @error('inventory_remarks')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image">Upload Image:</label>
                                        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                                        <div id="image-preview-container" style="display: none; margin-top: 10px;">
                                            <img id="image-preview" src="" alt="Image Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                        </div>
                                    </div>                                                                    
                                </div>
                            </div>
                            <!-- Submit and Cancel Buttons -->
                            <div>
                                <button type="button" id="addAssetButton" class="btn btn-primary">Save Asset</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            dropdownParent: $('#addAssetModal'),
            minimumResultsForSearch: 0 // Always show the search box
        });

        const serialNumberField = document.getElementById('serial_number');
        const addAssetModal = document.getElementById('addAssetModal');

        addAssetModal.addEventListener('shown.bs.modal', function () {
            serialNumberField.focus();
        });

        serialNumberField.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                alert('Serial number scanned: ' + serialNumberField.value);
            }
        });
    });
</script>


</script>

<script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>   
<!-- Core JavaScript libraries -->
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> <!-- Bootstrap is foundational -->
<script src="{{ URL::asset('assets/libs/alertifyjs/alertifyjs.min.js') }}"></script> <!-- AlertifyJS should be loaded after Bootstrap -->
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
<!-- DataTables libraries -->
<script src="{{ URL::asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>

<!-- Your custom scripts -->
<script src="{{ URL::asset('assets/js/pages/notification.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    // Trigger the form submission automatically on selection change
    document.getElementById('acquisition_cost_filter').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>
<script>
    // Function to toggle visibility of input fields based on radio button selection
    function toggleFields() {
        // Get the selected radio button value
        var selectedOption = document.querySelector('input[name="number_type"]:checked').value;

        // Show/Hide fields based on the selected option
        if (selectedOption === 'engine') {
            document.getElementById('engine_number_field').style.display = 'block';
            document.getElementById('elc_number_field').style.display = 'block';
            document.getElementById('plate_number_field').style.display = 'block';
            document.getElementById('chasis_number_field').style.display = 'block';
            document.getElementById('serial_number_field').style.display = 'none';
        } else if (selectedOption === 'serial') {
            document.getElementById('serial_number_field').style.display = 'block';
            document.getElementById('engine_number_field').style.display = 'none';
            document.getElementById('elc_number_field').style.display = 'none';
            document.getElementById('plate_number_field').style.display = 'none';
            document.getElementById('chasis_number_field').style.display = 'none';
        }
    }

    // Initialize the toggle functionality based on default radio button selection
    window.onload = function() {
        toggleFields();
    };
</script>
<script>
    function previewImage(event) {
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imagePreview = document.getElementById('image-preview');
        
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block';  // Show the preview container
            };
            reader.readAsDataURL(file);
        } else {
            imagePreviewContainer.style.display = 'none';  // Hide preview container if no file is selected
        }
    }

</script>

<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>

    
@endsection
