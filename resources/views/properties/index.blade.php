// resources/views/properties/index.blade.php

@extends('layouts.master-layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Properties</h2>

                <form>
                    <div class="form-group">
                        <label for="searchInput">Search:</label>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search properties...">
                    </div>
                </form>

                <table class="table table-striped" id="propertiesTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>Property Number</th>
                            <th>Description</th>
                            <th>Office</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Account</th>
                            <th>Employee</th>
                            <th>Employee 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td><input type="checkbox" name="selected_ids[]" value="{{ $property->id }}"></td>
                                <td>{{ $property->property_number }}</td>
                                <td>{{ $property->description }}</td>
                                <td>{{ $property->office->name }}</td>
                                <td>{{ $property->category->name }}</td>
                                <td>{{ $property->status->name }}</td>
                                <td>{{ $property->account->name }}</td>
                                <td>{{ $property->employee->name }}</td>
                                <td>{{ $property->employee2->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button id="exportButton" class="btn btn-primary" disabled>Export Selected</button>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    // Select all checkboxes
    $('#selectAll').on('click', function() {
        var isChecked = this.checked;  // Get the status of "Select All"
        $('input[name="selected_ids[]"]').prop('checked', isChecked);
        toggleExportButton();  // Update export button status based on checkbox state
    });

    // Select/deselect checkboxes
    $('input[name="selected_ids[]"]').on('click', function() {
        toggleExportButton();  // Update export button status based on checkbox state
    });

    // Function to enable or disable the export button
    function toggleExportButton() {
        var selectedIds = [];
        $('input[name="selected_ids[]"]:checked').each(function() {
            selectedIds.push($(this).val());
        });

        // Enable/disable export button based on selected checkboxes
        $('#exportButton').prop('disabled', selectedIds.length === 0);
    }

    // Export selected properties
    $('#exportButton').on('click', function() {
        var selectedIds = [];
        $('input[name="selected_ids[]"]:checked').each(function() {
            selectedIds.push($(this).val());
        });

        // Redirect to the export route with the selected IDs
        window.location.href = "{{ route('properties.export') }}?selected_ids=" + selectedIds.join(',');
    });

    // Search properties
    $('#searchInput').on('keyup', function() {
        var searchQuery = $(this).val();

        $.ajax({
            type: 'GET',
            url: "{{ route('properties.index') }}",
            data: { search: searchQuery },
            success: function(data) {
                // Update table view
                $('#propertiesTable').html(data);
            }
        });
    });

    // Toggle column visibility
    $('.toggle-column').on('click', function() {
        var columnId = $(this).data('column-id');
        $('#' + columnId).toggle();
    });
});

</script>
@endsection
