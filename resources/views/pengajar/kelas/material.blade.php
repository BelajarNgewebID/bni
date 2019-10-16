@extends('layouts.dashboard')

@section('title', 'Kelas | Belajar Ngeweb ID')

@section('head.dependencies')
<style>
    .lebar-33 { width: 33.3%; }
    .navigation .active { color: #f15b2d;font-family: ProBold; }
    #btnCreate {
        position: fixed;
        bottom: 7.5%;right: 5%;
        width: 65px;
        height: 65px;
        padding: 0px;
        font-size: 30px;
        font-family: ProBold;
    }
</style>
@endsection

@section('content')
<div class="lebar-100">
    <h1 class="d-inline-block">{{ $classData->title }}</h1>
</div>

@include('layouts.menuKelas')

<div class="row">
    <div class="content bg-putih rounded bayangan-5 p-1">
        <div class="wrap">
            @if ($materials->count() == 0)
                <h3>Tidak ada materi</h3>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $item)
                            <tr>
                                <td>
                                    {{ $item->title }}
                                    <div class="ke-kanan">
                                        <a href="#" class="teks-oren"><i class="fas fa-edit"></i></a>
                                        &nbsp; 
                                        <a href="{{ route('material.delete', $item->id) }}" class="teks-merah"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<a href="{{ route('material.upload', $classData->id) }}">
    <button id="btnCreate" class="oren rounded-circle">+</button>
</a>

@endsection
