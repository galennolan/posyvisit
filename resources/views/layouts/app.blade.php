<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PosyVisit') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
          <!-- Scripts untuk DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    // Tambahkan log ini untuk memastikan script berjalan
    console.log('DataTables scripts loaded successfully');

    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#keluargaTable').DataTable({
            "scrollX": true, // Scrollable horizontal
            "responsive": true, // Membuat tabel responsif
            "searching": true, // Enable pencarian
            "paging": true, // Enable pagination
            "info": true // Show info bar
        });

        // Log untuk memastikan DataTables dijalankan
        console.log('DataTables initialized successfully');
    });
</script>   
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert untuk pesan sukses -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<!-- SweetAlert untuk pesan error -->
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

    </body>
</html>
