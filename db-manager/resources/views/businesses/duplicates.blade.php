@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Duplicate Records</h1>
        <a href="{{ route('businesses.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
            Back to Businesses
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (count($duplicateGroups) == 0)
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-500 text-lg">No duplicate records found.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach ($duplicateGroups as $group)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="mb-4 pb-4 border-b">
                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $group[0]->business_name ?? 'Unknown' }} 
                            <span class="text-sm font-normal text-gray-500">({{ count($group) }} records)</span>
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $group[0]->city ?? 'N/A' }} | {{ $group[0]->area ?? 'N/A' }} | {{ $group[0]->address ?? 'N/A' }}
                        </p>
                    </div>

                    <form action="{{ route('businesses.merge') }}" method="POST" class="mb-4">
                        @csrf

                        <div class="mb-4 p-4 rounded bg-blue-50 border border-blue-100 text-sm text-blue-800">
                            <p class="font-semibold">Merge instructions:</p>
                            <p>Select one record as the <strong>master</strong> (keep it unchanged).</p>
                            <p>Then choose the other duplicate records to merge into that master.</p>
                            <p><strong>Do not</strong> select the chosen master record in the checkbox list.</p>
                        </div>

                        <div class="overflow-x-auto mb-4">
                            <table class="min-w-full border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-4 py-2">
                                            <input type="radio" name="master_id" class="form-radio" disabled> Master
                                        </th>
                                        <th class="border px-4 py-2 text-left">Business Name</th>
                                        <th class="border px-4 py-2 text-left">Mobile</th>
                                        <th class="border px-4 py-2 text-left">Category</th>
                                        <th class="border px-4 py-2 text-left">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group as $business)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="border px-4 py-2 text-center">
                                                <input type="radio" name="master_id" value="{{ $business->id }}" class="form-radio" 
                                                    @if ($loop->first) checked @endif>
                                            </td>
                                            <td class="border px-4 py-2">{{ $business->business_name ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $business->mobile_no ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $business->category ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $business->address ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Select Records to Merge:</label>
                            <div class="space-y-2">
                                @foreach ($group as $business)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="duplicate_ids[]" value="{{ $business->id }}" class="form-checkbox"
                                            @if (!$loop->first) checked @endif>
                                        <span class="ml-2">{{ $business->business_name ?? 'N/A' }} (ID: {{ $business->id }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-200 w-full">
                            Merge Selected Records
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
