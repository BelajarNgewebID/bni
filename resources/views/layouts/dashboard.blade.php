<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/variable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    @yield('head.dependencies')
</head>
<body>

<nav class="menu">
    <li class="p-5"><h2>Panel Pengajar</h2></li>
    <a href="{{ route('pengajar.dashboard') }}">
        <li class="{{ (Route::currentRouteName() == 'pengajar.dashboard') ? 'active' : 'none' }}">
            <div class="icon"><i class="fas fa-home"></i></div>
            <span>Dasbor</span>
        </li>
    </a>
    <a href="{{ route('pengajar.kelas') }}">
        <li class="{{ (Route::currentRouteName() == 'pengajar.kelas') ? 'active' : 'none' }}">
            <div class="icon"><i class="fas fa-school"></i></div>
            <span>Kelas</span>
        </li>
    </a>
    <a href="{{ route('pengajar.earning') }}">
        <li class="{{ (Route::currentRouteName() == 'pengajar.earning') ? 'active' : 'none' }}">
            <div class="icon"><i class="fas fa-money-bill-alt"></i></div>
            <span>Pendapatan</span>
        </li>
    </a>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="{{ asset('js/embo.js') }}"></script>
@yield('javascript')

</body>
</html>