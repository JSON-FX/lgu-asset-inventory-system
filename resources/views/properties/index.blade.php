@extends('layouts.master-layouts')
@section('title') @lang('Generate Reports') @endsection

@section('css')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css">
<link rel="stylesheet" href="//rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css">
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Reports @endslot
@slot('title') Generate Reports @endslot
@endcomponent

<div class="container">
    <h1>Assets Table</h1>
  
    <p>A table with third-party integration extensions: Filter control, Sorting, and Data export.</p>
    
    <!-- Toolbar with Export options -->
    <div id="toolbar">
        <select class="form-control">
            <option value="">Export Basic</option>
            <option value="all">Export All</option>
            <option value="selected">Export Selected</option>
        </select>

        <!-- Column Visibility Toggle Button -->
        <button class="btn btn-secondary" id="column-toggle">Toggle Columns</button>
    </div>
    
    <!-- Laravel Dynamic Table for Properties -->
    <table class="table table-striped" id="propertiesTable" 
           data-toggle="table"
           data-search="true"
           data-filter-control="true"
           data-show-export="true"
           data-click-to-select="true"
           data-toolbar="#toolbar"
           data-show-columns="true"> <!-- Enable Column Visibility Toggle -->
      <thead>
        <tr>
          <th data-field="state" data-checkbox="true"></th>
          <th data-field="property_number" data-sortable="true" data-filter-control="input">Property Number</th>
          <th data-field="description" data-sortable="true" data-filter-control="input">Description</th>
          <th data-field="office" data-sortable="true" data-filter-control="input">Office</th>
          <th data-field="category" data-sortable="true" data-filter-control="select">Category</th>
          <th data-field="status" data-sortable="true" data-filter-control="select">Status</th>
          <th data-field="account" data-sortable="true" data-filter-control="select">Account</th>
          <th data-field="employee" data-sortable="true" data-filter-control="input">End User</th>
          <th data-field="employee2" data-sortable="true" data-filter-control="input">Accountable</th>
        </tr>
      </thead>
      <tbody>
        <!-- Blade Loop to Display Properties -->
        @foreach($properties as $property)
          <tr>
            <td><input type="checkbox" name="selected_ids[]" value="{{ $property->id }}"></td>
            <td>{{ $property->property_number }}</td>
            <td>{{ $property->description }}</td>
            <td>{{ $property->office->office_name }}</td>
            <td>{{ $property->category->category_name }}</td>
            <td>{{ $property->status->status_name }}</td>
            <td>{{ $property->account->account_name }}</td>
            <td>{{ $property->employee->employee_name }}</td>
            <td>{{ $property->employee2->employee_name }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>

@endsection

@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js'></script>
<script src='//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js'></script>

<script>
  // Initializing the table with the export and column toggle functionality
  var $table = $('#propertiesTable');
  
  $(function () {
    // Export functionality
    $('#toolbar').find('select').change(function () {
      $table.bootstrapTable('refreshOptions', {
        exportDataType: $(this).val()
      });
    });

    // Column visibility toggle functionality
    $('#column-toggle').click(function () {
      // Use the built-in Bootstrap Table function to toggle columns visibility
      var columns = $table.bootstrapTable('getVisibleColumns'); // Get all visible columns
      var hiddenColumns = $table.bootstrapTable('getHiddenColumns'); // Get all hidden columns

      // This toggle function will alternate between showing and hiding the columns
      if (columns.length > 0) {
        $table.bootstrapTable('toggleColumns', hiddenColumns); // Show hidden columns and hide visible columns
      } else {
        $table.bootstrapTable('toggleColumns', columns); // Show visible columns and hide hidden ones
      }
    });
  });

  // Highlight selected rows when clicked
  var trBoldBlue = $("table");
  $(trBoldBlue).on("click", "tr", function () {
    $(this).toggleClass("bold-blue");
  });
</script>
@endsection
