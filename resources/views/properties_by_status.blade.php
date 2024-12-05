<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties by Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Assets by Status</h1>

    @foreach ($statuses as $status)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Status: {{ $status->status_name }}</h4>
            </div>
            <div class="card-body">
                @if ($status->properties->isEmpty())
                    <p class="text-danger">No properties found for this status.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Property Number</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Category</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status->properties as $property)
                                <tr>
                                    <td>{{ $property->property_number }}</td>
                                    <td>{{ $property->description }}</td>
                                    <td>{{ $property->employee->employee_name }}</td>
                                    <td>{{ $property->category->category_name }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endforeach
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
