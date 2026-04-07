@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Business Report</h1>
        <a href="{{ route('businesses.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
            Back to Businesses
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <h3 class="text-gray-600 text-sm font-semibold">Total Listings</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalCount }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <h3 class="text-gray-600 text-sm font-semibold">Unique Listings</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $uniqueCount }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <h3 class="text-gray-600 text-sm font-semibold">Duplicate Listings</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $duplicateCount }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
            <h3 class="text-gray-600 text-sm font-semibold">Incomplete Listings</h3>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $incompleteCount }}</p>
        </div>
    </div>

    <!-- City-Wise Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">City-wise Data</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">City</th>
                            <th class="px-4 py-2 text-right text-sm font-semibold">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cityWiseData as $data)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $data->city ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-right font-semibold">{{ $data->count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-4 text-center text-gray-500">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Category + City-wise Data -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Category + City-wise Data</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Category</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">City</th>
                            <th class="px-4 py-2 text-right text-sm font-semibold">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categoryCityData as $data)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm">{{ $data->category ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-sm">{{ $data->city ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-right font-semibold text-sm">{{ $data->count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category + Area-wise Data -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Category + Area-wise Data</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Category</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Area</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categoryAreaData as $data)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm">{{ $data->category ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $data->area ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-right font-semibold text-sm">{{ $data->count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Export Options -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Export Report</h2>
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
            Export as PDF
        </button>
    </div>
</div>
@endsection
