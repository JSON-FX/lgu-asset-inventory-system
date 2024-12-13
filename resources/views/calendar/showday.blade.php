<?php use Carbon\Carbon; ?>
@extends('layouts.master')

@section('title') Day Details @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Calendar @endslot
@slot('title') Day Details @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Details for {{ $calendarEntry ? $calendarEntry->date->format('Y-m-d') : $day->format('Y-m-d') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="{{ route('calendar.index') }}" class="btn btn-primary">Back to Calendar</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if($calendarEntry)
                    <p><strong>Total Entries:</strong> {{ $totalAssets }}</p>
                    <p><strong>Description:</strong> {{ $calendarEntry->description ?? 'No description available.' }}</p>
                @else
                    <p>No calendar entry for this date.</p>
                @endif

                <h3>Properties Added on {{ $day->format('Y-m-d') }}</h3>

                @if($properties->isNotEmpty())
                    <div class="table-responsive mb-4">
                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Acquisition Cost</th>
                                    <th>Purchased Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $property)
                                    <tr class="hover:bg-opacity-50 hover:bg-gray-200 transition-colors duration-300">
                                        <td>{{ $property->description }}</td>
                                        <td>{{ $property->acquisition_cost }}</td>
                                        <td>{{ \Carbon\Carbon::parse($property->date_purchase)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No properties added on this day.</p>
                @endif
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
@endsection
