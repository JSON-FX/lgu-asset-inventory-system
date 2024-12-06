@extends('layouts.master')
@section('title') @lang('Asset List') @endsection
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3  text-end " >                     
                        <a href="{{ route('assetlist.create') }}" class="btn btn-success"><i class="bx bx-plus me-1"></i> Add Asset</a>
                    </div>
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead class="table-light">
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
                                                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
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
                                                <a href="{{ route('asset.exportexcel', $property->id) }}" class="btn btn-success">
                                                    Export to Excel
                                                </a>
                                                <a href="{{ route('asset.exportpdf', $property->id) }}" class="btn btn-danger">
                                                    Export to PDF
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
