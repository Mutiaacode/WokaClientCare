<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Woka Client Care')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/wokalog.svg') }}" />

    <!-- THEME CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/themify-icons/themify-icons.css') }}" />

    <!-- GOOGLE FONT: OUTFIT -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- GLOBAL STYLE OVERRIDES -->
    <style>
        :root {
            --topbar-height: 64px;
        }

        .invoice-header {
            background: linear-gradient(135deg, #2c3e50, #3991A2);
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

        /* ─── Fixed Topbar ───────────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            /* Sesuaikan dengan lebar sidebar */
            height: var(--topbar-height);
            z-index: 1000;
            background: white !important;
            border-bottom: 1px solid #e9ecef !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            transition: left 0.3s ease;
        }

        /* ─── Adjust Body for Fixed Topbar ───────────── */
        .body-wrapper {
            margin-top: var(--topbar-height);
            min-height: calc(100vh - var(--topbar-height));
        }

        /* ─── Sidebar Adjustments ───────────────────── */
        .left-sidebar {
            top: 0 !important;
            height: 100vh !important;
            position: fixed;
            z-index: 1001;
        }

        .scroll-sidebar {
            height: 100vh !important;
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .left-sidebar .simplebar-content-wrapper {
            padding-top: 0 !important;
        }

        /* ─── Page Content Spacing ─────────────────── */
        .page-inner {
            padding-top: 20px !important;
            padding-bottom: 30px !important;
        }

        /* ─── Card Spacing ─────────────────────────── */
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* ─── Responsive Adjustments ───────────────── */
        @media (max-width: 992px) {
            .topbar {
                left: 0 !important;
            }

            .body-wrapper {
                margin-left: 0;
            }
        }

        /* ─── Topbar Specific Styles ───────────────── */
        .topbar .navbar-brand {
            padding: 0;
        }

        .topbar .dropdown-toggle::after {
            display: none;
        }

        .topbar .btn-link {
            text-decoration: none;
        }

        .topbar .input-group {
            max-width: 300px;
        }

        .topbar .badge {
            font-size: 10px;
            padding: 2px 5px;
        }

        /* ─── Improve Breadcrumb ───────────────────── */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
            font-size: 0.875rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }

        .breadcrumb-item a {
            color: #2c5aa0;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* ─── Page Title ───────────────────────────── */
        h4 {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Topbar --}}
        @include('partials.topbar')

        {{-- Content Wrapper --}}
        <div class="body-wrapper bg-light">
            <div class="container-fluid page-inner">

                {{-- Breadcrumb & Title --}}
                <div
                    class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
                    <div class="mb-2 mb-sm-0">
                        <h4 class="mb-1 mt-3">@yield('page-title', 'Dashboard')</h4>
                        <p class="text-muted small mb-0"></p>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a
                                    href="
                @switch(auth()->user()->role)
                    @case('admin')
                        {{ route('admin.dashboard') }}
                        @break
                    @case('client')
                        {{ route('client.dashboard') }}
                        @break
                    @case('staff')
                        {{ route('staff.dashboard') }}
                        @break
                    @case('teknisi')
                        {{ route('teknisi.dashboard') }}
                        @break
                    @default
                        {{ route('dashboard') }}
                @endswitch
            ">
                                    <i class="ti ti-home me-1"></i>Home
                                </a>
                            </li>

                            <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                        </ol>
                    </nav>

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

    <script>
        // Handle sidebar collapse and topbar adjustment
        document.addEventListener('DOMContentLoaded', function() {
            const topbar = document.querySelector('.topbar');
            const sidebar = document.querySelector('.left-sidebar');

            // Initial setup
            updateTopbarPosition();

            // Update on window resize
            window.addEventListener('resize', updateTopbarPosition);

            function updateTopbarPosition() {
                if (window.innerWidth >= 992) {
                    // Desktop
                    const sidebarWidth = sidebar.offsetWidth;
                    topbar.style.left = sidebarWidth + 'px';
                    topbar.style.right = '0';
                } else {
                    // Mobile
                    topbar.style.left = '0';
                    topbar.style.right = '0';
                }
            }

            // Handle sidebar collapse/expand
            const sidebarToggle = document.querySelector('[data-bs-target="#sidebarMenu"]');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    setTimeout(updateTopbarPosition, 300); // Wait for animation
                });
            }

            // Update position when sidebar state changes
            const sidebarMenu = document.getElementById('sidebarMenu');
            if (sidebarMenu) {
                sidebarMenu.addEventListener('hidden.bs.collapse', updateTopbarPosition);
                sidebarMenu.addEventListener('shown.bs.collapse', updateTopbarPosition);
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
