@extends('layouts.master-layouts')
@section('title') @lang('Trash')  @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title') Trashed @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Trashed List</h4>

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="table-light">
                        <tr>
                            <th>Prop No.</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Purchase Date</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($trashedProperties as $property)
                        <tr class="hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                            <td>{{ $property->property_number }}</td>
                            <td>{{ $property->description }}</td>
                            <td>{{ $property->category->category_name }}</td>
                            <td>{{ $property->date_purchase ? $property->date_purchase->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $property->employee->employee_name }}</td>
                            <td>{{ $property->status->status_name }}</td>
                            <td>{{ $property->deleted_at ? \Carbon\Carbon::parse($property->deleted_at)->timezone('+08:00')->format('m-d-Y h:i:A') : 'N/A' }}</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a class="mdi mdi-eye font-size-18" data-bs-toggle="modal" data-bs-target="#orderdetailsModal-{{ $property->id }}"></a>
                                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#restoreModal-{{ $property->id }}">Restore</a>
                                    
                                    @if(auth()->id() == 1)
                                        <a href="javascript:void(0);" 
                                        class="btn btn-danger btn-sm" 
                                        data-bs-toggle="modal"                                         
                                        data-bs-target="#deleteModal-{{ $property->id }}"
                                        >
                                            Permanently Delete
                                        </a>
                                    @endif

                                </div>
                            </td>
                            
                        </tr>
                        <div class="modal fade" id="restoreModal-{{ $property->id }}" tabindex="-1" aria-labelledby="restoreModalLabel-{{ $property->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="restoreModalLabel-{{ $property->id }}">Confirm Restoration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to restore <strong>{{ $property->description }}</strong> from trash?
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Form for restoration -->
                                        <form id="restoreAssetForm"action="{{ route('asset.restore', $property->id) }}" method="GET">
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" id="restoreAssetButton"class="btn btn-success">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Modal for deletion confirmation (outside the loop) -->
                        <div class="modal fade" id="deleteModal-{{ $property->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $property->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel-{{ $property->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to permanently delete the asset <strong>{{ $property->description }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Form that submits the delete request -->
                                        <form action="{{ route('asset.forceDelete', $property->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Yes, Permanently Delete</button>
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
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No trashed assets found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('restoreAssetButton').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default button behavior

        // Display success alert after form submission
        Swal.fire({
            title: 'Success!',
            text: 'Asset Restored successfully.',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        }).then(() => {
            // Submit the form after showing the success alert
            document.getElementById('restoreAssetForm').submit();
        });
    });
</script>
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
@endsection
