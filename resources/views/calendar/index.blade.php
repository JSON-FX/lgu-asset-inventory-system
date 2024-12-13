<?php use Carbon\Carbon; ?>
@extends('layouts.master')

@section('title') 
    @lang('translation.Calendars') 
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/@fullcalendar/@fullcalendar.min.css') }}" rel="stylesheet">
    <style>
        .calendar {
            width: 100%;
            border-collapse: collapse;
        }
        .calendar th, .calendar td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .calendar th {
            background-color: #f4f4f4;
        }
        .month-navigation {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') Apps @endslot
    @slot('title') Calendar @endslot
@endcomponent

<div class="month-navigation">
    <a href="{{ route('calendar.index', ['month' => $previousMonth->format('Y-m')]) }}" class="btn">Previous Month</a>
    <span>{{ $currentMonth->format('F Y') }}</span>
    <a href="{{ route('calendar.index', ['month' => $nextMonth->format('Y-m')]) }}" class="btn">Next Month</a>
</div>

<h2>Calendar for {{ $currentMonth->format('F Y') }}</h2>

<table class="calendar">
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
            // Get the first and last date of the current month
            $startOfMonth = $currentMonth->copy()->startOfMonth();
            $endOfMonth = $currentMonth->copy()->endOfMonth();

            // Set the current date to the start of the week (Monday)
            $currentDate = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        @endphp

        @while($currentDate <= $endOfMonth)
            <tr>
                @foreach(range(0, 6) as $dayOfWeek)
                    @php
                        $currentDay = $currentDate->copy()->addDays($dayOfWeek);
                    @endphp
                    <td>
                        @if($currentDay->month == $currentMonth->month)
                            <a href="{{ route('calendar.showDay', $currentDay->format('Y-m-d')) }}">
                                {{ $currentDay->day }}
                            </a><br>
                            @php
                                // Get the total assets for the current day
                                $totalAssets = \App\Models\CalendarEntry::getTotalAssetsForDate($currentDay->format('Y-m-d'));
                            @endphp
                            Total Assets: <span class="badge {{ $totalAssets == 0 ? '' : 'bg-success text-white font-weight-bold fs-4' }}">
                                {{ number_format($totalAssets) }}
                            </span>
                        @else
                            &nbsp; <!-- Empty cell for days outside the current month -->
                        @endif
                    </td>
                @endforeach
            </tr>
            @php
                // Move to the next week
                $currentDate->addWeek();
            @endphp
        @endwhile
    </tbody>
</table>

@endsection
