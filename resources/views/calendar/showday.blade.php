<?php use Carbon\Carbon; ?>
@extends('layouts.master')

@section('title') Day Details @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Calendar @endslot
@slot('title') Day Details @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Assets Added on {{ $calendarEntry ? $calendarEntry->date->format('Y-m-d') : $day->format('Y-m-d') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="{{ route('calendar.index') }}" class="btn btn-primary">Back to Calendar</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if($calendarEntry)
                    <p><strong>Total Assets:</strong> {{ $totalAssets }}</p>
                @else
                    <p>No Assets Added on this date.</p>
                @endif

                

                @if($properties->isNotEmpty())
                    <div class="table-responsive mb-4">
                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Acquisition Cost</th>
                                    <th>Purchased Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $property)
                                    <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                        <td>{{ $property->description }}</td>
                                        <td>{{ $property->acquisition_cost }}</td>
                                        <td>{{ \Carbon\Carbon::parse($property->date_purchase)->format('Y-m-d') }}</td>
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
                @else
                    <p>No properties added on this day.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatable-pages.init.js') }}"></script>
@endsection
