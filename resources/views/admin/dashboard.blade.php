@extends('layouts.dashboardAdmin')

@section('title', 'Dashboard Admin | Belajar Ngeweb ID')

@section('content')
<div class="card">
    <div class="bagi bagi-3">
        <div class="wrap bg-putih rounded bayangan-5 p-2">
            <h1 class="mt-0">{{ $totalClass }}</h1>
            kelas
        </div>
    </div>
    <div class="bagi bagi-3">
        <div class="wrap bg-putih rounded bayangan-5 p-2">
            <h1 class="mt-0">{{ $totalMaterial }}</h1>
            materi
        </div>
    </div>
    <div class="bagi bagi-3">
        <div class="wrap bg-putih rounded bayangan-5 p-2">
            <h1 class="mt-0">{{ $totalParticipant }}</h1>
            peserta
        </div>
    </div>
</div>

<div>
    <div class="bagi bagi-2">
        <div class="wrap bg-putih rounded bayangan-5 p-1">
            <div class="wrap">
                <h2>Kelas Terbaru</h2>
            </div>
        </div>
    </div>
    <div class="bagi bagi-2">
        <div class="wrap bg-putih rounded bayangan-5 p-1">
            <div class="wrap">
                <h2>Kelas Terbaru</h2>
            </div>
        </div>
    </div>
</div>
@endsection