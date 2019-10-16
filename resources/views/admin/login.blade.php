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
        <h1>Login Admin</h1>
        <div class="bg-putih bayangan-5 mt-4 rounded p-1">
            <form action="{{ route('admin.login') }}" method="POST" class="wrap">
                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="bg-merah-transparan p-2 mb-3 rounded">
                            {{ $err }}
                        </div>
                    @endforeach
                @endif
                <div>E-mail :</div>
                <input type="email" class="box" name="email" required>
                <div class="mt-3">Password :</div>
                <input type="password" class="box" name="password" required>
                <div class="mt-3">
                    <button class="oren lebar-100">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection