@extends('layouts.master')
@section('title') @lang('translation.Data_Tables') @endsection
@section('css')
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
    
    <a href="javascript: void(0);"  id="alert-message" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a></td>
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
                                <th>Office</th>
                                <th>Purchase date</th>
                                <th>User</th>
                                <th>Acquisition cost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->property_number }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->description }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->category->category_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->office->office_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ \Carbon\Carbon::parse($property->date_purchase)->format('m-d-Y') }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->employee->employee_name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">₱{{ number_format($property->acquisition_cost, 2) }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->status->status_name }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <!-- Eye Icon to open the modal -->
                                            <a class="mdi mdi-eye font-size-18" data-bs-toggle="modal" data-bs-target="#orderdetailsModal-{{ $property->id }}"></a>
                                            <a href="{{ route('assetlist.editassetlist', $property->id) }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="{{ route('assetlist.delete', $property->id) }}" class="text-danger" onclick="return confirm('Are you sure you want to delete this asset?')">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                            
                                    </td>
                                </tr>

                                <!-- Modal for this specific property -->
                                <div class="modal fade" id="orderdetailsModal-{{ $property->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel-{{ $property->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> <!-- Added modal-lg -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="orderdetailsModalLabel-{{ $property->id }}">Details for {{ $property->property_number }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Left Column: QR Code and Image -->
                                                    <div class="col-xl-4">
                                                        <div class="product-detai-imgs">
                                                            <div class="row">
                                                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                                                    <div class="tab-content" id="v-pills-tabContent">
                                                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                                                            <div>
                                                                                <div class="img-fluid mx-auto d-block">
                                                                                    {!! QrCode::size(180)->generate($property->property_number) !!} <!-- Increased QR Code Size -->
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
                                                            <h5 class="mt-1 mb-3">Property No.</h5>
                                                            <p class="text-muted sm-4">{{ $property->property_number }}</p>
                                                            <h5 class="mt-1 mb-3">Serial No.</h5>
                                                            <p class="text-muted sm-4">{{ $property->serial_number }}</p>
                                                            <h5 class="mt-1 mb-3">Description</h5>
                                                            <p class="text-muted sm-4">{{ $property->description }}</p>
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
                                                            <h5 class="mt-1 mb-3">User</h5>
                                                            <p class="text-muted sm-4">{{ $property->employee->employee_name }}</p>
                                                            <h5 class="mt-1 mb-3">Date Purchased</h5>
                                                            <p class="text-muted sm-4">{{ \Carbon\Carbon::parse($property->date_purchase)->format('m-d-Y') }}</p>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Core JavaScript libraries -->
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> <!-- Bootstrap is foundational -->
<script src="{{ URL::asset('assets/libs/alertifyjs/alertifyjs.min.js') }}"></script> <!-- AlertifyJS should be loaded after Bootstrap -->

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
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>

    
@endsection
