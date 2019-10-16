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
    <li class="p-5"><h2>Panel Admin</h2></li>
    <a href="{{ route('admin.dashboard') }}">
        <li class="{{ (Route::currentRouteName() == 'admin.dashboard') ? 'active' : 'none' }}">
            <div class="icon"><i class="fas fa-home"></i></div>
            <span>Dashboard</span>
        </li>
    </a>
    <a href="{{ route('admin.invoice') }}">
        <li class="{{ (Route::currentRouteName() == 'admin.invoice') ? 'active' : 'none' }}">
            <div class="icon"><i class="fas fa-money-bill-alt"></i></div>
            <span>Invoice</span>
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