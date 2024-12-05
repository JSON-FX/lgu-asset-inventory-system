@extends('layouts.master')

@section('title') Assets by Category @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title') Assets by Category @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        @foreach ($categories as $category)
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{ $category->category_name }}</h5>
                    <span class="badge badge-soft-secondary font-size-14">{{ $category->properties->count() }} assets</span>
                </div>
                
                <div class="card-body">
                    @if ($category->properties->isEmpty())
                        <p class="text-danger text-center">No properties found for this category.</p>
                    @else
                        <div class="table-responsive mb-4">
                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                   style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Property Number</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->properties as $property)
                                        <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                            <td>{{ $property->property_number }}</td>
                                            <td>{{ $property->description }}</td>
                                            {{-- <td>{{ $property->status->status_name }}</td> --}}
                                            <td>
                                                <span class="badge badge-pill 
                                                    @if ($property->status->status_name == 'Maintenance')
                                                        badge-soft-warning
                                                    @elseif ($property->status->status_name == 'Serviceable')
                                                        badge-soft-success
                                                    @elseif ($property->status->status_name == 'Unserviceable')
                                                        badge-soft-danger
                                                    @else
                                                        badge-soft-secondary
                                                    @endif
                                                    font-size-12">
                                                    {{ $property->status->status_name }}
                                                </span>
                                            </td>
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
