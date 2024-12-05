@extends('layouts.master')
@section('title') Assets by Status @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title') Assets by Status @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        @foreach ($statuses as $status)
            <div class="card mb-2">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Status: {{ $status->status_name }}</h5>
                    <span class="badge badge-soft-secondary font-size-14">{{ $status->properties->count() }} assets</span>
                </div>
                <div class="card-body">
                    @if ($status->properties->isEmpty())
                        <p class="text-danger text-center">No assets found for this status.</p>
                    @else
                        <div class="table-responsive mb-4">
                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                   style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Property Number</th>
                                        <th>Description</th>
                                        <th>User</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($status->properties as $property)
                                        <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                            <td>{{ $property->property_number }}</td>
                                            <td>{{ $property->description }}</td>
                                            <td>{{ $property->employee->employee_name }}</td>
                                            <td>{{ $property->category->category_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
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
