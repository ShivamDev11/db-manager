@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Businesses</h1>
        <div class="space-x-2">
            <a href="{{ route('import.form') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                Import Data
            </a>
            <a href="{{ route('businesses.duplicates') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                Duplicates
            </a>
            <a href="{{ route('businesses.report') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                Report
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Business Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">City</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Area</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Category</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Mobile</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($businesses as $business)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">
                            @if ($business->is_duplicate)
                                <span class="text-yellow-600">{{ $business->business_name ?? 'N/A' }}</span>
                            @else
                                {{ $business->business_name ?? 'N/A' }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $business->city ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $business->area ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $business->category ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $business->mobile_no ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="space-y-1">
                                @if ($business->is_incomplete)
                                    <span class="inline-block bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">Incomplete</span>
                                @endif
                                @if ($business->is_duplicate)
                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Duplicate</span>
                                @else
                                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Unique</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="space-x-2">
                                <a href="{{ route('businesses.show', $business->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">View</a>
                                <form action="{{ route('businesses.destroy', $business->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 hover:text-red-700 text-sm font-semibold">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No businesses found. <a href="{{ route('import.form') }}" class="text-blue-500 hover:text-blue-700">Import data</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $businesses->links() }}
    </div>
</div>
@endsection
