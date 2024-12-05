@extends('layouts.master')
@section('title') @lang('translation.Dashboards') @endsection
@section('css')

<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<style>/* Basic card styling */
    .card {
    
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card-body {
        padding: 20px;
        transition: background-color 0.3s ease;
    }
    
    /* Hover effect */
    .card:hover {
        transform: scale(1.05); /* Slight zoom on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .card-body:hover {
        background-color: #dedede; /* Subtle background color change */
    }
    
    /* Optional: Title styling */
    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    /* Optional: Text styling */
    .card-text {
        font-size: 14px;
        color: #555;
    }
    </style>
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title')  @endslot
@endcomponent

<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- Wrap the card inside the anchor tag -->
        <a href="asset" class="block no-underline">
            <!-- card -->
            <div class="card card-h-100 hover:shadow-lg transition-shadow duration-300">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!-- Left Section -->
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Assets</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $totalProperties }}">0</span>
                            </h4>
                        </div>
                        <!-- Right Section -->
                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart1" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </a>
    </div><!-- end col -->
    

    <div class="col-xl-3 col-md-6">
        <!-- Wrap the card inside the anchor tag -->
        <a href="properties-by-status" class="block no-underline">
            <!-- card -->
            <div class="card card-h-100 hover:shadow-lg transition-shadow duration-300">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!-- Left Section -->
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Assets by Status</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $propertiesByStatus }}">0</span>
                            </h4>
                        </div>
                        <!-- Right Section -->
                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart2" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </a>
    </div><!-- end col -->
    

    <div class="col-xl-3 col-md-6">
        <!-- Wrap the card inside the anchor tag -->
        <a href="category-assets" class="block no-underline">
            <!-- card -->
            <div class="card card-h-100 hover:shadow-lg transition-shadow duration-300">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!-- Left Section -->
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Assets by Category</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $propertiesByCategory }}">0</span>
                            </h4>
                        </div>
                        <!-- Right Section -->
                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart3" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </a>
    </div><!-- end col -->
    

    <div class="col-xl-3 col-md-6">
        <!-- Wrap the card inside the anchor tag -->
        <a href="asset/trash" class="block no-underline">
            <!-- card -->
            <div class="card card-h-100 hover:shadow-lg transition-shadow duration-300">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!-- Left Section -->
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Trashed Assets</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $totalTrash }}">0</span>
                            </h4>
                        </div>
                        <!-- Right Section -->
                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart4" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </a>
    </div><!-- end col -->
    


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
