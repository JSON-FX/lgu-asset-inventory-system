@extends('layouts.master')
@section('title') @lang('translation.Data_Tables')  @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title') Assets List @endslot
@endcomponent



<div class="row">
    <div class="col-12">
        
        <div class="card">
            
            <div class="card-body">
            
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>Prop No.</th>
                        <th>Description</th>
                        <th>Category</th>
                        {{-- <th>Serial No.</th> --}}
                        <th>Office</th>
                        <th>Purchase date</th>
                        <th>User</th>
                        <th>Acquisition cost</th>
                        <th>Status</th>
                        <th>Action</th>
                      
                    </thead>


                    <tbody>
                        @forelse ($properties as $property)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200">
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->property_number }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->description }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->category->category_name }}</td>
                            {{-- <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->serial_number }}</td> --}}
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->office->office_name }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->date_purchase }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->employee->employee_name }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">₱{{ number_format($property->acquisition_cost, 2) }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->status->status_name }} </td> 
    
                            <td>
                                <div class="d-flex gap-3">
                                    <a  class="mdi mdi-eye font-size-18"data-bs-toggle="modal" data-bs-target=".orderdetailsModal"></a>
                                    <a href="{{ route('assetlist.editassetlist', $property->id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a href="{{ route('assetlist.delete', $property->id) }}" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a> 
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-4 py-2 text-center">No assets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end cardaa -->
    </div> <!-- end col -->
</div>
<div class="modal fade orderdetailsModal" id="orderdetailsModal-{{ $property->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetailsModalLabel">Asset Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="product-detai-imgs">
                            <div class="row">
                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                            <div>
                                                <div class="img-fluid mx-auto d-block">
                                                    {!! QrCode::size(100)->generate($property->property_number) !!}
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
                            <h5 class="mt-1 mb-3">Property Number</h5>
                            <p class="text-muted sm-4">{{ $property->property_number }}</p>
                            <h5 class="mt-1 mb-3">Serial Number</h5>
                            <p class="text-muted sm-4">{{ $property->serial_number }}</p>
                            <h5 class="mt-1 mb-3">Description</h5>
                            <p class="text-muted sm-4">{{ $property->description }}</p>
                            <h5 class="mt-1 mb-3">Category</h5>
                            <p class="text-muted sm-4">{{ $property->category->category_name }}</p>
                            <h5 class="mt-1 mb-3">Office</h5>
                            <p class="text-muted sm-4">{{ $property->office->office_name }}</p>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="mt-4 mt-xl-3">
                            <h5 class="mt-1 mb-3">Status</h5>
                            <p class="text-muted sm-4">{{ $property->status->status_name }}</p>
                            <h5 class="mt-1 mb-3">User</h5>
                            <p class="text-muted sm-4">{{ $property->employee->employee_name }}</p>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
@endsection
