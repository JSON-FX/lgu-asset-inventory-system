@extends('layouts.master')
@section('title') @lang('translation.Office_List') @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Offices @endslot
@slot('title') Office List @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <!-- Flex container to align the heading and button side by side -->
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Office List <span class="text-muted fw-normal ms-2">({{ $office->count() }})</span></h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOfficeModal"><i class="bx bx-plus me-1"></i> Add Office</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Make table scrollable on small screens -->
                <div class="table-responsive mb-4">
                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Office Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($office as $item)
                                <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->office_name }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#editOfficeModal{{ $item->id }}">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No offices found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table responsive -->
            </div>
        </div>
    </div>
</div>

<!-- Add Office Modal -->
<div class="modal fade" id="addOfficeModal" tabindex="-1" aria-labelledby="addOfficeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficeModalLabel">Add New Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('offices.store') }}" method="POST">
                    @csrf

                    <!-- Office Name -->
                    <div class="mb-4">
                        <label for="office_name" class="form-label">Office Name</label>
                        <input 
                            type="text" 
                            id="office_name" 
                            name="office_name" 
                            value="{{ old('office_name') }}" 
                            class="form-control" 
                            required>
                        @error('office_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Office</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Office Modals -->
@foreach ($office as $item)
    <div class="modal fade" id="editOfficeModal{{ $item->id }}" tabindex="-1" aria-labelledby="editOfficeModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfficeModalLabel{{ $item->id }}">Edit Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('offices.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Office Name -->
                        <div class="mb-4">
                            <label for="office_name" class="form-label">Office Name</label>
                            <input 
                                type="text" 
                                id="office_name" 
                                name="office_name" 
                                value="{{ old('office_name', $item->office_name) }}" 
                                class="form-control" 
                                required>
                            @error('office_name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Office</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatable-pages.init.js') }}"></script>
@endsection
