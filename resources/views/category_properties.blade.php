<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties by Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Assets by Category</h1>

    @foreach ($categories as $category)
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Category: {{ $category->category_name }}</h4>
            </div>
            <div class="card-body">
                @if ($category->properties->isEmpty())
                    <p class="text-danger">No properties found for this category.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Property Number</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->properties as $property)
                                <tr>
                                    <td>{{ $property->property_number }}</td>
                                    <td>{{ $property->description }}</td>
                                    <td>{{ $property->status->status_name }}</td>
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
