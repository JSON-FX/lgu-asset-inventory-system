@extends('layouts.master-layouts')
@section('title') @lang('Account') @endsection

@section('css')
@section('content')
@component('components.breadcrumb')
@slot('li_1') Search @endslot
@slot('title')  @endslot
@endcomponent
    <div class="container mt-5">
        <h1>Search Results for "{{ $searchQuery }}"</h1>
        
        @if($properties->isEmpty())
            <p>No results found.</p>
        @else
            <ul class="list-group">
                @foreach($properties->take(1) as $property)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ asset('storage/' . $property->image_path) }}" target="_blank">
                            <img 
                                src="{{ asset('storage/' . $property->image_path) }}" 
                                alt="Property Image" 
                                style="width: 180px; height: 180px; object-fit: cover;">
                        </a>
                        <strong>{{ $property->property_number }}
                            
                        </strong>{{ $property->description }}
                        
                        
                        <!-- Button to trigger the modal with more detailed information -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderdetailsModal-{{ $property->id }}">
                            View Details
                        </button>
                    </li>

                    <!-- Modal for each property -->
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
                                                <p class="text-muted sm-4">{{ $property->category_name }}</p>
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
                                                <p class="text-muted sm-4">{{  number_format($property->qty,0) }}</p>
                                        
                                                <h5 class="mt-1 mb-3">Inventory Remarks</h5>
                                                <p class="text-muted sm-4">{{ $property->inventory_remarks }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

@section('scripts')
    <!-- Include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
@section('script')
<script src="{{ URL::asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatable-pages.init.js') }}"></script>
@endsection
