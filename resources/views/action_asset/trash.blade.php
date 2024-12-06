@extends('layouts.master')
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
                                    <a href="{{ route('asset.restore', $property->id) }}" class="btn btn-success btn-sm">Restore</a>
                                    <a href="javascript:void(0);" 
                                        class="btn btn-danger btn-sm" 
                                        data-bs-toggle="modal"                                         
                                        data-bs-target="#deleteModal-{{ $property->id }}"
                                        >Permanently Delete</a>
                                </div>
                            </td>
                        </tr>

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
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
@endsection
