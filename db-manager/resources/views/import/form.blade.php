@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Import Businesses</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Error:</strong> {{ $errors->first() }}
            </div>
        @endif

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

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="file" class="block text-gray-700 font-bold mb-2">
                        Upload CSV or Excel File
                    </label>
                    <input 
                        type="file" 
                        name="file" 
                        id="file" 
                        accept=".csv,.xlsx,.xls"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <p class="text-sm text-gray-600 mt-2">Supported formats: CSV, XLSX, XLS (Max 5MB)</p>
                </div>

                <div class="mb-4 p-4 bg-blue-50 rounded">
                    <h3 class="font-bold text-blue-900 mb-2">Required Columns:</h3>
                    <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                        <li>Business Name</li>
                        <li>Area</li>
                        <li>City</li>
                        <li>Mobile No.</li>
                        <li>Category</li>
                        <li>Sub-Category</li>
                        <li>Address (optional)</li>
                    </ul>
                </div>

                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-200"
                    >
                        Import File
                    </button>
                    <a 
                        href="{{ route('businesses.index') }}"
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md text-center transition duration-200"
                    >
                        View Businesses
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <h3 class="font-bold text-lg mb-3">Sample File Format</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-3 py-2 text-sm">Business Name</th>
                            <th class="border px-3 py-2 text-sm">Area</th>
                            <th class="border px-3 py-2 text-sm">City</th>
                            <th class="border px-3 py-2 text-sm">Mobile No</th>
                            <th class="border px-3 py-2 text-sm">Category</th>
                            <th class="border px-3 py-2 text-sm">Sub-Category</th>
                            <th class="border px-3 py-2 text-sm">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                            <td class="border px-3 py-2 text-sm">ABC Store</td>
                            <td class="border px-3 py-2 text-sm">Downtown</td>
                            <td class="border px-3 py-2 text-sm">New York</td>
                            <td class="border px-3 py-2 text-sm">1234567890</td>
                            <td class="border px-3 py-2 text-sm">Retail</td>
                            <td class="border px-3 py-2 text-sm">General Store</td>
                            <td class="border px-3 py-2 text-sm">123 Main St</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
