@extends('layouts.user')

@section('title', 'Invoice | Belajar Ngeweb ID')
@section('title.second', 'Invoice')

@php
    function toIdr($angka) {
        return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
@endphp

@section('content')
<div class="container mb-5">
    <div class="rata-tengah">
        <div class="rata-kiri d-inline-block lebar-60">
            @if ($inv->count() == 0)
                <div class="rata-tengah">
                    <h2>Tidak ada tagihan</h2>
                    <a href="{{ route('user.listKelas') }}">
                        <button class="oren">Lihat kelas saya</button>
                    </a>
                </div>
            @else
                <h2>List kelas yang belum dibayar</h2>
                @foreach ($inv as $item)
                    <div class="bg-putih rounded mb-2 p-2 pb-1">
                        <div class="bag bag-10 d-inline-block">
                            <p>{{ $item->material->title }}</p>
                            <p class="teks-transparan">{{ toIdr($item->to_pay) }}</p>
                        </div>
                    </div>
                @endforeach
                @php
                    $totalToPay = $inv->sum('to_pay');
                @endphp
                <h3>Total : {{ toIdr($totalToPay) }}</h3>
                <form action="{{ route('invoice.bayar') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <p>Sertakan bukti transfer untuk membayar tagihan</p>
                    <input type="file" class="box" name="evidence">
                    <div class="bg-merah p-2 mt-2 rounded">
                        asidj
                    </div>
                    <button class="oren mt-3">Bayar</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection