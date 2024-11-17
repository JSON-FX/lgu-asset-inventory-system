<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white white:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <h1>Asset Management</h1>

            <!-- Table to display asset details -->
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Asset Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Condition</th>
                        <th>Status</th>
                        <th>Purchase Date</th>
                        <th>Purchase Price</th>
                        <th>Serial Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assets as $asset)
                        <tr>
                            <td>{{ $asset->id }}</td>
                            <td>{{ $asset->asset_code }}</td>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->category->name ?? 'N/A' }}</td>  <!-- Category name, default to 'N/A' if not available -->
                            <td>{{ $asset->location->name ?? 'N/A' }}</td>  <!-- Location name, default to 'N/A' if not available -->
                            <td>{{ ucfirst($asset->condition) }}</td>  <!-- Display condition (capitalize first letter) -->
                            <td>{{ ucfirst($asset->status) }}</td>  <!-- Display status (capitalize first letter) -->
                            <td>{{ $asset->purchase_date }}</td>
                            <td>${{ number_format($asset->purchase_price, 2) }}</td>  <!-- Format price with 2 decimal places -->
                            <td>{{ $asset->serial_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
