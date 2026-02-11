<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccoSys</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            background-color: #1e3a8a;
            color: white;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
        }

        .sidebar a {
            color: #cfd8dc;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #102a71;
            border-left-color: #3b82f6;
            color: white;
        }

        /* THIS IS THE KEY FIX */
        .main-content {
            margin-left: 250px;
            padding: 24px;
            min-height: 100vh;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- SIDEBAR --}}
    @include('partials.sidebar')

    {{-- PAGE CONTENT --}}
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
