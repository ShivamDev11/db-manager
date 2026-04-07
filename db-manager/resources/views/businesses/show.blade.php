@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <a href="{{ route('businesses.index') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">← Back to Businesses</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Business Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ $business->business_name ?? 'N/A' }}</h1>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">City</label>
                            <p class="text-lg text-gray-800">{{ $business->city ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Area</label>
                            <p class="text-lg text-gray-800">{{ $business->area ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Mobile Number</label>
                            <p class="text-lg text-gray-800">{{ $business->mobile_no ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Category</label>
                            <p class="text-lg text-gray-800">{{ $business->category ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Sub-Category</label>
                            <p class="text-lg text-gray-800">{{ $business->sub_category ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 font-semibold">Address</label>
                        <p class="text-lg text-gray-800">{{ $business->address ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <div class="flex gap-4">
                        <form action="{{ route('businesses.destroy', $business->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                                Delete Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status and Duplicates -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Status</h3>
                <div class="space-y-2">
                    @if ($business->is_incomplete)
                        <div class="flex items-center p-3 bg-red-100 rounded">
                            <span class="text-red-700 font-semibold">⚠ Incomplete Record</span>
                        </div>
                    @endif

                    @if ($business->is_duplicate)
                        <div class="flex items-center p-3 bg-yellow-100 rounded">
                            <span class="text-yellow-700 font-semibold">🔄 Duplicate Record</span>
                        </div>
                        @if ($business->master_id)
                            <div class="p-3 bg-blue-100 rounded">
                                <p class="text-sm text-blue-700">Master Record: ID #{{ $business->master_id }}</p>
                            </div>
                        @endif
                    @else
                        <div class="flex items-center p-3 bg-green-100 rounded">
                            <span class="text-green-700 font-semibold">✓ Unique Record</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Related Duplicates -->
            @if (count($duplicates) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">
                        Related Duplicates ({{ count($duplicates) }})
                    </h3>
                    <div class="space-y-2">
                        @foreach ($duplicates as $duplicate)
                            <a href="{{ route('businesses.show', $duplicate->id) }}" class="block p-3 bg-gray-50 hover:bg-gray-100 rounded border border-gray-200 transition duration-200">
                                <p class="font-semibold text-gray-800">{{ $duplicate->business_name ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">ID: {{ $duplicate->id }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Metadata -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Information</h3>
                <div class="space-y-2 text-sm">
                    <div>
                        <span class="text-gray-600">Record ID:</span>
                        <span class="font-semibold text-gray-800">{{ $business->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-semibold text-gray-800">{{ $business->created_at->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Updated:</span>
                        <span class="font-semibold text-gray-800">{{ $business->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
