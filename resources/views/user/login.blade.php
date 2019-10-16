@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<style>
    @media (max-width: 480px) {
        .container > div { width: 95%; }
    }
</style>
<div class="mt-5 rata-tengah container">
    <div class="lebar-35 d-inline-block rata-kiri mt-3">
        <h1>Login</h1>
        <div class="bg-putih bayangan-5 rounded p-1">
            <form action="{{ route('user.login') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="bg-merah-transparan p-2 mb-3 rounded">
                            {{ $err }}
                        </div>
                    @endforeach
                @endif
                <input type="hidden" name="reto" value="{{ $reto }}">
                <div>E-mail :</div>
                <input type="email" class="box" name="email" required>
                <div class="mt-3">Password :</div>
                <input type="password" class="box" name="password" required>
                <div class="mt-3">
                    <button class="oren lebar-100">Login</button>
                </div>
            </form>
            <div class="mt-3 mb-2 rata-tengah">
                belum punya akun? <a href="{{ route('user.registerPage') }}" class="teks-oren">buat akun</a> sekarang!
            </div>
        </div>
    </div>
</div>
@endsection