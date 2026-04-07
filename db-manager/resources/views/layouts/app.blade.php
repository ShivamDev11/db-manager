<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('businesses.index') }}" class="text-2xl font-bold">
                    📊 DB Manager
                </a>
                <div class="space-x-6">
                    <a href="{{ route('businesses.index') }}" class="hover:text-blue-200 transition">Businesses</a>
                    <a href="{{ route('import.form') }}" class="hover:text-blue-200 transition">Import</a>
                    <a href="{{ route('businesses.duplicates') }}" class="hover:text-blue-200 transition">Duplicates</a>
                    <a href="{{ route('businesses.report') }}" class="hover:text-blue-200 transition">Report</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        <p>&copy; 2024 Database Manager. All rights reserved.</p>
    </footer>
</body>
</html>
