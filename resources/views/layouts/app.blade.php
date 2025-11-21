<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>
  
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/libs/themify-icons/themify-icons.css') }}" />
  @stack('styles')
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" 
       data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" 
       data-sidebar-position="fixed" data-header-position="fixed">

    {{-- Topbar --}}
    @include('partials.topbar')

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Content Wrapper --}}
    <div class="body-wrapper bg-light">
      <div class="container-fluid py-4">
        {{-- Breadcrumb & page title --}}
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
  @stack('scripts')
</body>
</html>
