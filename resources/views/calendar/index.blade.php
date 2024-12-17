<?php use Carbon\Carbon; ?>
@extends('layouts.master')

@section('title') 
    @lang('translation.Calendars') 
@endsection

@section('css')
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
@endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') Apps @endslot
    @slot('title') Calendar @endslot
@endcomponent

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

<script>
    function jumpToMonthYear() {
        const selectedMonth = document.getElementById('month-select').value;
        const selectedYear = document.getElementById('year-select').value;

        // Redirect to the selected month and year
        window.location.href = `/calendar?month=${selectedYear}-${selectedMonth.padStart(2, '0')}`;
    }
</script>

@endsection
