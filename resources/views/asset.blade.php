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
@slot('title') Assets List @endslot
@endcomponent



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
                        {{-- <th>Serial No.</th> --}}
                        <th>Office</th>
                        <th>Purchase date</th>
                        <th>User</th>
                        <th>Acquisition cost</th>
                        <th>Status</th>
                        <th>Action</th>
                      
                    </thead>


                    <tbody>
                        @forelse ($properties as $property)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200">
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->property_number }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->description }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->category->category_name }}</td>
                            {{-- <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->serial_number }}</td> --}}
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->office->office_name }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->date_purchase }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->employee->employee_name }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">₱{{ number_format($property->acquisition_cost, 2) }}</td>
                            <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ $property->status->status_name }} </td> 
    
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('assetlist.view', $property->id) }}" class="mdi mdi-eye font-size-18"></a>
                                    <a href="{{ route('assetlist.editassetlist', $property->id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a href="{{ route('assetlist.delete', $property->id) }}" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a> 
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-4 py-2 text-center">No assets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end cardaa -->
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
