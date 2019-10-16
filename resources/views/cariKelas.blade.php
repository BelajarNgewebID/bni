@extends('layouts.user')

@section('title', 'Belajar Ngeweb ID | Belajar Ngeweb ID')
@section('title.second', 'Kelas Saya')

@inject('ClassCtrl', 'App\Http\Controllers\ClassController')

@section('head.dependencies')
<style>
    .container { top: 120px; }
    .kelas .cover {
        height: 200px;
        background-size: cover !important;
        background-position: center center !important;
    }
    .kelas h4 { line-height: 25px; }
    .kelas .header {
        line-height: 50px;
        padding: 0px 25px;
        display: flex;
        align-items: center;
    }
    .kelas .authorsAvatar {
        width: 30px;
        height: 30px;
        float: left;
        margin-right: 10px;
    }
    .pencarian {
        position: fixed;
        top: 20px;left: 30%;right: 30%;
        z-index: 3;
    }
    .pencarian button { margin-left: -71px;border-top-left-radius: 0px;border-bottom-left-radius: 0px; }
    .pencarian input { width: 89.2%; }
</style>
@endsection

@section('content')
<div class="container mb-4">
    <form action="{{ route('user.cariKelas') }}" class="pencarian">
        <input type="text" class="box-2" value="{{ $term }}" placeholder="Cari tutorial..." name="term">
        <button class="ml-1 oren rounded-circle"><i class="fas fa-search"></i></button>
    </form>
    @foreach ($datas as $item)
    <div class="kelas bag lebar-25">
        <div class="wrap">
            <div class="bg-putih rounded pb-1">
                <div class="header">
                    <img src="{{ asset('storage/avatars/'. $item->users->photo) }}" class="authorsAvatar rounded-circle">
                    {{ $item->users->name }}
                </div>
                <div class="cover" style="background: url('{{ asset('storage/kelas/'.$ClassCtrl::slug($item->title).'/'.$item->cover) }}')"></div>
                <div class="wrap">
                    <h4>{{ $item->title }}</h4>
                    <a href="{{ route('kelas.detail', $item->id) }}">
                        <button class="oren-alt lebar-100 tinggi-50 p-0">Detail Kelas</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection