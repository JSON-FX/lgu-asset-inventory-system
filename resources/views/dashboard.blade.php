@extends('layouts.master')
@section('title') @lang('Dashboard') @endsection
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
    .no-hover-card {
    border: none;
    box-shadow: none;
    transform: none; /* Prevent zoom effect */
    transition: none; /* No transition */
    }

    .no-hover-card .card-body {
        background-color: transparent; /* No background color change on hover */
        transition: none; /* No transition */
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
        <a href="asset-by-status" class="block no-underline">
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
<div class="col-12">
    <div class="card no-hover-card"> 
        <div class="card-body no-hover-card">
            <div id="top-offices-chart"></div>
        </div>
    </div>
</div>
    

    


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ensure `topOfficesData` is properly loaded
        var topOfficesData = @json($officesWithProperties) || [];
        console.log("Top Offices Data:", topOfficesData);

        // Validate and sanitize the data
        if (!Array.isArray(topOfficesData) || topOfficesData.length === 0) {
            console.error("Invalid or empty data for chart");
            return;
        }

        // Extract categories (office names) and series data (property counts)
        var officeNames = topOfficesData.map(office => office.office_name || "Unknown Office");
        var propertyCounts = topOfficesData.map(office => office.properties_count || 0);

        // Chart options
        var options = {
            chart: {
                type: 'bar',
                height: 300,
                
            },
            series: [
                {
                    name: 'Assets',
                    data: propertyCounts, // Use sanitized property counts
                },
            ],
            xaxis: {
                categories: officeNames, // Use sanitized office names
                title: { text: 'Offices' },
            },
            yaxis: {
                title: { text: 'Number of Assets' },
            },
            colors: ['#1c84ee'],
            title: {
                text: 'Top Performing Offices',
                align: 'center',
            },
        };

        // Initialize and render the chart
        var chart = new ApexCharts(document.querySelector("#top-offices-chart"), options);
        chart.render();
    });
</script>

<!-- Additional scripts -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection
