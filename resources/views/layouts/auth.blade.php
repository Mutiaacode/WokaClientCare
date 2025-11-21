{{-- Ini layouth auth untuk halaman login --}}

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <!-- Font -->
    <link href="{{ asset('css2?family=Nunito:wght@400;500;600;700;800&display=swap') }}" rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>
<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased"
    :class="[$store.app.sidebar ? 'toggle-sidebar' : '',
        $store.app.theme === 'dark' || $store.app.isDarkMode ? 'dark' : '',
        $store.app.menu,
        $store.app.layout,
        $store.app.rtlClass
    ]">
    <div
        class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path>
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s"
                    repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    <!-- Scroll to top button -->
    <div class="fixed bottom-6 right-6 z-50" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button" class="btn btn-outline-primary animate-pulse rounded-full p-2" @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                    <path></path>
                </svg>
            </button>
        </template>
    </div>
    <div class="main-container min-h-screen text-black dark:text-white-dark">
        <div x-data="auth">
            <div class="absolute inset-0">
                <img src="{{ asset('assets/images/auth/bg-gradient.png') }}" alt="image"
                    class="h-full w-full object-cover">
            </div>
            <div
                class="relative flex min-h-screen items-center justify-center bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

                <img src="{{ asset('assets/images/auth/coming-soon-object1.png') }}"
                    class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2">
                <img src="{{ asset('assets/images/auth/coming-soon-object2.png') }}"
                    class="absolute left-24 top-0 h-40 md:left-[30%]">
                <img src="{{ asset('assets/images/auth/coming-soon-object3.png') }}"
                    class="absolute right-0 top-0 h-[300px]">
                <img src="{{ asset('assets/images/auth/polygon-object.svg') }}" class="absolute bottom-0 end-[28%]">
                <div class="relative w-full max-w-[870px] rounded-md p-2">
                    <div
                        class="relative flex flex-col justify-center rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 px-6 py-20 lg:min-h-[758px]">
                        <!-- LANGUAGE DROPDOWN -->
                        <div class="absolute top-6 end-6">
                            <div class="dropdown" x-data="dropdown" @click.outside="open = false">
                                <a href="javascript:;"
                                    class="flex items-center gap-2.5 rounded-lg bg-white px-2 py-1.5 border hover:text-primary dark:bg-black"
                                    @click="toggle">
                                    <img :src="`{{ asset('assets/images/flags') }}/${$store.app.locale.toUpperCase()}.svg`"
                                        class="h-5 w-5 rounded-full">
                                    <div x-text="$store.app.locale" class="text-base font-bold uppercase"></div>
                                </a>
                            </div>
                        </div>

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/alpine-collaspe.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-persist.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-focus.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
