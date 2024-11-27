<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6 space-y-8">

        <!-- Dashboard Title -->
        <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
        
        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Total Properties -->
            <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Total Assets</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $totalProperties }}</p>
            </div>

            <!-- Properties by Category -->
            <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Assets by Category</h2>
                <ul class="space-y-2">
                    @foreach($propertiesByCategory as $categoryId => $total)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">Category ID: {{ $categoryId }}</span>
                            <span class="text-gray-800 font-semibold">{{ $total }} Assets</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Additional Stats (Optional) -->
            <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Additional Stats</h2>
                <!-- Add any additional stats here -->
                <p class="text-xl text-gray-600">Coming soon!</p>
            </div>
        </div>

    </div>
</x-app-layout>
