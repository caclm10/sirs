<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle', config('custom.app_name'))</title>

    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    @stack('styles')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer>
    </script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js" defer></script>
    <script src="https://unpkg.com/imask@6.4.2/dist/imask.js" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <script src="/js/app.js" defer></script>
    @stack('scripts')
</head>

<body>
    {{-- @if (session('success'))
        <input type="hidden" id="success-toast" value="{{ session('success') }}">
    @endif --}}

    {{-- Sidebar Overlay --}}
    <div class="sidebar-overlay d-none p-5 mobile-sidebar-toggler"></div>
    {{-- End of Sidebar Overlay --}}

    {{-- Sidebar --}}
    <aside class="sidebar d-none d-lg-block">
        <div class="mb-5 px-4">
            <img src="/images/logo.png" alt="logo" width="47" height="56" class="d-inline-block me-4">
            <h2 class="fw-500 fs-normal mb-0 d-inline-block text-uppercase">{{ config('custom.app_name') }}</h2>
        </div>

        <nav class="sidebar__menu">
            <x-sidebar-menu />
        </nav>
    </aside>

    {{-- Mobile Sidebar --}}
    <aside class="sidebar-mobile hide d-lg-none bg-white">
        <div class="mb-5 px-4">
            <img src="/images/logo.png" alt="logo" width="47" height="56" class="d-inline-block me-4">
            <h2 class="fw-500 fs-normal mb-0 d-inline-block text-uppercase">{{ config('custom.app_name') }}</h2>
        </div>

        <nav class="sidebar__menu">
            <x-sidebar-menu />
        </nav>

        <div class="px-4 d-flex justify-content-center pt-5">
            <button type="button" class="btn-close mobile-sidebar-toggler mx-auto" aria-label="Close"></button>
        </div>
    </aside>
    {{-- End of Mobile Sidebar --}}


    {{-- Navbar --}}
    <header class="navbar">
        <div class="d-flex align-items-center">
            <span class="sidebar-toggler iconify me-4 fs-4 text-primary cursor-pointer d-none d-lg-block"
                data-icon="carbon:menu"></span>
            <span class="mobile-sidebar-toggler iconify me-4 fs-4 text-primary cursor-pointer d-lg-none"
                data-icon="carbon:menu"></span>
            <h1 class="fs-5 mb-0 d-none d-lg-block">@yield('dashboard-title')</h1>
        </div>
        <div class="d-flex align-items-center">
            <div class="d-flex flex-column align-items-end me-3">
                <span class="">{{ auth()->user()->nama }}</span>
                <span class="fs-14px text-muted text-capitalize">{{ \AppHelper::getActiveGuard(true) }}</span>
            </div>
        </div>
    </header>

    <div class="h-115px"></div>

    <div class="main-container">
        <main class="p-35px">
            @yield('content')
        </main>
    </div>

</body>

</html>
