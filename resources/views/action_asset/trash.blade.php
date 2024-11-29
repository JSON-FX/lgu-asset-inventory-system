

<div class="container">
    <h1>Trashed Properties</h1>
    <div class="mb-3">
        <a href="{{ route('asset') }}" class="btn btn-primary">Back to Property List</a>
    </div>

    @if($trashedProperties->isEmpty())
        <div class="alert alert-info">No trashed properties found.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Property Number</th>
                    <th>Description</th>
                    <th>Serial Number</th>
                    <th>Engine Number</th>
                    <th>ELC Number</th>
                    <th>Office</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Employee</th>
                    <th>Acquisition Cost</th>
                    <th>Inventory Remarks</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trashedProperties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->property_number }}</td>
                        <td>{{ $property->description }}</td>
                        <td>{{ $property->serial_number ?? 'N/A' }}</td>
                        <td>{{ $property->engine_number ?? 'N/A' }}</td>
                        <td>{{ $property->elc_number ?? 'N/A' }}</td>
                        <td>{{ $property->office->office_name ?? 'N/A' }}</td>
                        <td>{{ $property->category->category_name ?? 'N/A' }}</td>
                        <td>{{ $property->status->status_name ?? 'N/A' }}</td>
                        <td>{{ $property->employee->employee_name ?? 'N/A' }}</td>

                        <td>{{ $property->acquisition_cost ? number_format($property->acquisition_cost, 2) : 'N/A' }}</td>
                        <td>{{ $property->inventory_remarks ?? 'N/A' }}</td>
                        <td>{{ $property->deleted_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('asset.restore', $property->id) }}" class="btn btn-success btn-sm">Restore</a>
                            <a href="{{ route('asset.forceDelete', $property->id) }}" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to permanently delete this property?');">
                                Permanently Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

