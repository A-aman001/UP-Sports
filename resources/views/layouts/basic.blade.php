<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('img/Logo_of_University_of_Phayao.svg.png') }}" type="image/png">
    <title>@yield('title', 'UP-Sports')</title>

    {{-- global css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    {{-- page-specific css --}}
    @stack('styles')
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <img src="{{ asset('img/logoDSASMART.png') }}" alt="DSA" class="brand-logo">
        </div>
    </header>

    <main class="wrap">
        @yield('content')
    </main>

    {{-- global js --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- page-specific js --}}
    @stack('scripts')
</body>

</html>
