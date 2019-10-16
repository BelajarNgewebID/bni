@extends('layouts.dashboard')

@section('title', 'Kelas | Belajar Ngeweb ID')

@inject('ClassCtrl', 'App\Http\Controllers\ClassController')

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
    <h1 class="d-inline-block">Kelas</h1>
    <div class="ke-kanan">
        <a href="{{ route('pengajar.createClass') }}"><button class="oren">Buat Kelas</button></a>
    </div>
</div>
<div class="row mt-2">
    @foreach ($classes as $item)
        <div class="kelas bag">
            <div class="wrap">
                <div class="bg-putih rounded pb-1 bayangan-5">
                    <div class="cover" style="background: url('{{ asset('storage/kelas/'.$ClassCtrl::slug($item->title).'/'.$item->cover) }}')"></div>
                    <div class="wrap">
                        <h4>{{ $item->title }}</h4>
                        <a href="{{ route('kelas.material', $item->id) }}">
                            <button class="bg-primer lebar-100 tinggi-50 p-0"><i class="fas fa-cogs"></i> &nbsp; Manage</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection