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
@slot('title') Trashed @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Trashed List</h4>

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
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
                        <tr>
                            
                            <td>{{ $property->property_number }}</td>
                            <td>{{ $property->description }}</td>
                            <td>{{ $property->category->category_name }}</td>
                            <td>{{ $property->date_purchase ? $property->date_purchase->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $property->employee->employee_name }}</td>
                            
                            <td>{{ $property->status->status_name }}</td>
                            <td>{{ $property->deleted_at ? $property->deleted_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('asset.restore', $property->id) }}" class="btn btn-success btn-sm">Restore</a>
                                    <a href="{{ route('asset.forceDelete', $property->id) }}" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to permanently delete this property?');">
                                        Permanently Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No trashed properties found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

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
