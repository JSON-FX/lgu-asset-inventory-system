<?php use Carbon\Carbon; ?>
@extends('layouts.master')
@section('title') @lang('Dashboard') @endsection
@section('css')

<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/assets/libs/@fullcalendar/@fullcalendar.min.css') }}" rel="stylesheet">
<style>
    .calendar-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .calendar-table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
    }
    .calendar-table th {
        padding: 15px;
        background-color: #1c84ee;
        color: #ffffff;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }
    .calendar-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #eaeaea;
        vertical-align: top;
        position: relative;
    }
    .calendar-table td a {
        display: block;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 5px;
        color: #1c84ee;
        text-decoration: none;
    }
    .calendar-table td a:hover {
        text-decoration: underline;
    }
    .calendar-table td .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 12px;
    }
    .calendar-table td .bg-success {
        background-color: #28a745 !important;
    }
    .calendar-table td .bg-warning {
        background-color: #ffc107 !important;
    }
    .calendar-table td .bg-danger {
        background-color: #dc3545 !important;
    }
    .calendar-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .calendar-navigation a {
        padding: 10px 20px;
        background-color: #1c84ee;
        color: #ffffff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    .calendar-navigation a:hover {
        background-color: #1c84ee;
    }
    .calendar-navigation span {
        font-size: 18px;
        font-weight: bold;
    }
    .calendar-table td.empty {
        background-color: #f4f4f4;
    }
    /* UI/UX friendly Month and Year Selectors */
    .calendar-navigation select {
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ddd;
        background-color: #f7f7f7;
        width: auto;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .calendar-navigation select:hover {
        border-color: #1c84ee;
    }
    .calendar-navigation select:focus {
        outline: none;
        border-color: #1c84ee;
        box-shadow: 0 0 5px rgba(28, 132, 238, 0.3);
    }
    .calendar-navigation select option {
        padding: 10px;
    }
</style>
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
    
<div class="calendar-container">
    <div class="calendar-navigation">
        <a href="{{ route('calendar.index', ['month' => $previousMonth->format('Y-m')]) }}">Previous Month</a>
        
        <!-- Month and Year Selectors -->
        <div class="d-flex align-items-center">
            <select id="month-select" onchange="jumpToMonthYear()">
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}" {{ $currentMonth->month == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                    </option>
                @endforeach
            </select>
            <span class="mx-2">/</span>
            <select id="year-select" onchange="jumpToMonthYear()">
                @foreach(range(\Carbon\Carbon::now()->year - 5, \Carbon\Carbon::now()->year + 5) as $year)
                    <option value="{{ $year }}" {{ $currentMonth->year == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <a href="{{ route('calendar.index', ['month' => $nextMonth->format('Y-m')]) }}">Next Month</a>
    </div>

    <table class="calendar-table">
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody>
            @php
                $startOfMonth = $currentMonth->copy()->startOfMonth();
                $endOfMonth = $currentMonth->copy()->endOfMonth();
                $currentDate = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
            @endphp

            @while($currentDate <= $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY))
                <tr>
                    @foreach(range(0, 6) as $dayOfWeek)
                        @php $isInMonth = $currentDate->month == $currentMonth->month; @endphp
                        <td class="{{ !$isInMonth ? 'empty' : '' }}">
                            @if($isInMonth)
                                <a href="{{ route('calendar.showDay', $currentDate->format('Y-m-d')) }}">
                                    {{ $currentDate->day }}
                                </a>
                                @php
                                    $totalAssets = \App\Models\CalendarEntry::getTotalAssetsForDate($currentDate->format('Y-m-d'));
                                    $badgeClass = $totalAssets == 0 
                                        ? '' 
                                        : ($totalAssets < 100 ? 'bg-warning' : 'bg-success');
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ number_format($totalAssets) }}
                                </span>
                            @endif
                        </td>
                        @php $currentDate->addDay(); @endphp
                    @endforeach
                </tr>
            @endwhile
        </tbody>
    </table>
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
<script>
    function jumpToMonthYear() {
        const selectedMonth = document.getElementById('month-select').value;
        const selectedYear = document.getElementById('year-select').value;

        // Redirect to the selected month and year
        window.location.href = `/calendar?month=${selectedYear}-${selectedMonth.padStart(2, '0')}`;
    }
</script>

<!-- Additional scripts -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection
