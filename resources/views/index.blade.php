@extends('layouts.user')

@section('title', 'Belajar Ngeweb ID')
@section('title.second', 'Belajar Ngeweb ID')

@section('head.dependencies')

@endsection

@section('content')
<div class="container">
    <div class="bag bag-5">
        <h1>Welkam!</h1>
        <h2 class="mb-5 title index">Ada tutorial khusus buat kamu di sebelah kanan</h2>
        <form action="{{ route('user.cariKelas') }}">
            <div class="bag bag-7">
                <input type="text" class="box-2" name="term" placeholder="Atau cari sendiri tutorial favoritmu...">
            </div>
            <div class="bag bag-1">&nbsp;</div>
            <div class="bag bag-2">
                <button class="oren lebar-100">Cari</button>
            </div>
        </form>
    </div>
    <div class="bag bag-1"></div>
    <div class="bag bag-4 featured">
        <div class="thumbnail">
            <img src="{{ asset('img/cover.png') }}" class="rounded">
        </div>
        <h3>Tutorial cara mendownload gambar di Instagram dengan mudah</h3>
        <p class="text-muted author">
            <img src="{{ asset('img/iconsBni.png') }}" class="fotoProfilKecil ke-kiri mr-2">
            oleh <b>Belajar Ngeweb ID</b>
        </p>
    </div>
</div>
@endsection