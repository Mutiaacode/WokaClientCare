<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />

    <!-- THEME CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/themify-icons/themify-icons.css') }}" />

    <!-- GOOGLE FONT: OUTFIT -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- GLOBAL STYLE OVERRIDES -->
    <style>
        .invoice-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 30px;
        }

        .invoice-body {
            padding: 30px;
        }

        .invoice-footer {
            background: #f8f9fa;
            padding: 20px 30px;
            border-top: 1px solid #e9ecef;
        }

        .company-logo {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .amount-highlight {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .status-badge {
            font-size: 14px;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .detail-row {
            border-bottom: 1px solid #e9ecef;
            padding: 15px 0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .watermark {
            position: absolute;
            opacity: 0.03;
            font-size: 120px;
            transform: rotate(-45deg);
            z-index: 0;
            top: 30%;
            left: 10%;
            font-weight: bold;
            color: #2c3e50;
        }

        /* ─── Global Font ───────────────────────────── */


        /* ─── FIX SIDEBAR FULL KE ATAS ───────────────── */
        #main-wrapper {
            padding-top: 0 !important;
        }

        .left-sidebar {
            top: 0 !important;
            height: 100vh !important;
        }

        .scroll-sidebar {
            height: calc(100vh) !important;
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .left-sidebar .simplebar-content-wrapper {
            padding-top: 0 !important;
        }

        /* ─── Page Inner Spacing (Dashboard tidak mepet) ───── */
        .page-inner {
            padding-top: 50px !important;
            /* turun 50px */
            padding-bottom: 30px !important;
        }

        /* spacing antar card */
        .card {
            margin-bottom: 25px;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Content Wrapper --}}
        <div class="body-wrapper bg-light">
            <div class="container-fluid page-inner">

                {{-- Breadcrumb & Title --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                    </ol>
                </div>

                {{-- Main Content --}}
                @yield('content')

            </div>
        </div>

        {{-- Footer --}}
        @include('partials.footer')

    </div>

    {{-- JS --}}
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

@stack('scripts')
</body>

</html>
