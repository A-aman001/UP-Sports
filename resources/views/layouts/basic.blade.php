<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('img/Logo_of_University_of_Phayao.svg.png') }}" type="image/png">
    <title>@yield('title', 'UP-FMS')</title>
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <header class="topbar">
        <img src="{{ asset('img/logoDSASMART.png') }}" alt="DSA" height="60">
    </header>
    <main class="wrap">
        <section class="card">
            @yield('content')
        </section>
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
