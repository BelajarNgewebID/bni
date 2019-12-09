@extends('layouts.email')

@section('content')
<div class="container">
    <div class="wrap">
        <p>
            Halo {{ $firstName }}! Selamat Datang di Belajar Ngeweb ID
            <br /><br />
            Sebelum kamu mulai belajar bikin website, kamu harus mengaktifkan akun kamu dulu dengan mengklik tombol yang ada di bawah ini. Setelah itu baru kamu bisa
            belajar membuat sebuah website yang canggih banget
            <br /><br />
            <a href="{{ $link }}"><button>Aktifkan Akun</button></a>
            <br /><br />
            Dari Admin<br />
            Belajar Ngeweb ID
        </p>
    </div>
</div>
@endsection