<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-800"><a href="{{ route('users.index') }}">{{ config('app.name', 'Laravel') }}</a></h1>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-md">
            <div class="container mx-auto px-4 py-6 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery and DataTables JS from CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[1, 'asc']],
                "columnDefs": [
                    { "orderable": true, "targets": [1, 2] },
                    { "orderable": false, "targets": [0, 3] }
                ]
            });
        });
    </script>

    @include('sweetalert::alert')
</body>
</html>
