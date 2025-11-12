<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | SIMTI RSUDZM</title>

    <link rel="shortcut icon" href="{{ asset('adminkit/img/icons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('adminkit/img/icons/favicon.ico') }}" type="image/x-icon">
    
    <link href="{{ asset('adminkit/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

<footer class="py-3 mt-auto" style="font-size: 14px; color: #555;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div><strong>TIM IT UPTD RSUD dr. Zubir Mahmud</strong> &copy; {{ date('Y') }}</div>
            <div><strong>v{{ env('APP_VERSION', '1.0.0') }}</strong></div>
        </div>
    </div>
</footer>

    <script src="{{ asset('adminkit/js/app.js') }}"></script>
    <script>
        // Replace Feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>

    @stack('scripts')
</body>
</html>
