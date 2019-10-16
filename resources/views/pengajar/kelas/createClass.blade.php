@extends('layouts.dashboard')

@section('title', 'Kelas | Belajar Ngeweb ID')

@section('head.dependencies')
<style>
    .kelas { width: 33.3%; }
    .kelas .cover {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        height: 200px;
        background-size: cover !important;
        background-position: center center !important;
    }
    .kelas h4 { line-height: 25px; }
</style>
@endsection

@section('content')
<div class="lebar-100">
    <h1 class="d-inline-block">Buat Kelas</h1>
</div>
<div class="row mt-2">
    <div class="bg-putih rounded bayangan-5 p-1 mb-5">
        <div class="wrap">
            <form action="{{ route('kelas.create') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="bg-merah-transparan p-2 mb-1 rounded">
                            {{ $err }}
                        </div>
                    @endforeach
                @endif
                <div>Nama kelas :</div>
                <input type="text" class="box mt-1" name="title" placeholder="Misal : Membuat API dengan Laravel">
                <div class="mt-2">Deskripsi :</div>
                <textarea name="description" class="box mt-1" placeholder="Ceritakan apa yang akan dipelajari di kelas ini"></textarea>
                <div class="mt-2">Cover :</div>
                <input type="file" name="cover" class="box mt-1">
                <button class="oren mt-3">Buat!</button>
            </form>
        </div>
    </div>
</div>
@endsection
