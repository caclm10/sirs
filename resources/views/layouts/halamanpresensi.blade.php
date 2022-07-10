<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle', 'SMA Swasta Eria')</title>

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

<body style="background-color: #f9f9f9 ">
    @if (session('success'))
        <input type="hidden" id="success-toast" value="{{ session('success') }}">
    @endif

    {{-- Navbar --}}
    <header class="navbar expand shadow-sm" style="padding: 20px 35px">
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard.presensi.index') }}"><span
                    class="iconify me-4 fs-1 text-primary cursor-pointer" data-icon="ion:chevron-back-circle"></span>
            </a>
            <h1 class="fs-5 mb-0 d-none d-lg-block">@yield('dashboard-title')</h1>
        </div>
        <div class="d-flex align-items-center">
            <div class="d-flex flex-column align-items-end me-3">
                <span class="">{{ auth()->user()->nama }}</span>
                <span class="fs-14px text-muted text-capitalize">{{ \AppHelper::getActiveGuard() }}</span>
            </div>

            {{-- <span class="iconify fs-2" data-icon="carbon:user-avatar"></span> --}}
        </div>
    </header>

    <div class="h-115px"></div>

    <div class="">
        <main class="p-35px">
            @yield('content')
        </main>
    </div>

</body>

</html>
