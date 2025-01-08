@extends('layouts.master')
@section('title') @lang('Account') @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Account @endslot
@slot('title') Account List @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Account List <span class="text-muted fw-normal ms-2">({{ $account->count() }})</span></h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStatusModal"><i class="bx bx-plus me-1"></i> Add account</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Add account Modal -->
                <div class="modal fade" id="addStatusModal" tabindex="-1" aria-labelledby="addStatusModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addStatusModalLabel">Add New account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('account.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="account_name" class="form-label">account Name</label>
                                        <input type="text" id="account_name" name="account_name" class="form-control" required>
                                        @error('account_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit account Modal -->
                <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editStatusModalLabel">Edit account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editStatusForm" action="{{ route('account.update', 'account_id') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="edit_status_name" class="form-label">account Name</label>
                                        <input type="text" id="edit_status_name" name="account_name" class="form-control" required>
                                        @error('account_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Make table scrollable on small screens -->
                <div class="table-responsive mb-4">
                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>account</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($account as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <span class="badge badge-pill 
                                            @if ($item->account_name == 'Maintenance')
                                                badge-soft-warning
                                            @elseif ($item->account_name == 'Serviceable')
                                                badge-soft-success
                                            @elseif ($item->account_name == 'Unserviceable')
                                                badge-soft-danger
                                            @else
                                                badge-soft-secondary
                                            @endif
                                            font-size-12">
                                            {{ $item->account_name }}
                                        </span>
                                    </td>
                                    
                                    
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#editStatusModal" onclick="fillEditForm({{ $item->id }}, '{{ $item->account_name }}')"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            {{-- <a href="{{ route('account.destroy', $item->id) }}" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No account found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
                <!-- end table responsive -->
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
<script>
    function fillEditForm(id, statusName) {
        // Set the action URL to the update route
        document.getElementById('editStatusForm').action = '{{ route('account.update', 'status_id') }}'.replace('status_id', id);
        
        // Set the input field value
        document.getElementById('edit_status_name').value = statusName;
    }
</script>
@endsection
