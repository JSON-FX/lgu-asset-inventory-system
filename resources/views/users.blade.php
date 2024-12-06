@extends('layouts.master')
@section('title') @lang('Users') @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Users @endslot
@slot('title') Users List @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <!-- Flex container to align the heading and button side by side -->
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Users List <span class="text-muted fw-normal ms-2">({{ $employee->count() }})</span></h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bx bx-plus me-1"></i> Add User</a>
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
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employee as $item)
                                <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->employee_name }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table responsive -->
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <!-- User Name -->
                    <div class="mb-4">
                        <label for="employee_name" class="form-label">User Name</label>
                        <input 
                            type="text" 
                            id="employee_name" 
                            name="employee_name" 
                            value="{{ old('employee_name') }}" 
                            class="form-control" 
                            required>
                        @error('employee_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modals -->
@foreach ($employee as $item)
    <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $item->id }}">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('users.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- User Name -->
                        <div class="mb-4">
                            <label for="employee_name" class="form-label">User Name</label>
                            <input 
                                type="text" 
                                id="employee_name" 
                                name="employee_name" 
                                value="{{ old('employee_name', $item->employee_name) }}" 
                                class="form-control" 
                                required>
                            @error('employee_name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update User</button>
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
