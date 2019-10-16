@extends('layouts.user')

@section('title', 'Tagihan Dibayar | Belajar Ngeweb ID')
@section('title.second', 'Tagihan Dibayar')

@php
    function toIdr($angka) {
        return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
@endphp

@section('head.dependencies')
<style>
    p { line-height: 45px; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="rata-tengah">
        <div class="rata-kiri d-inline-block lebar-60">
            <p>
                Setelah ini, tunggu konfirmasi pembayaran yang kamu lakukan. Biasanya maksimal 6 jam. Kalau invoice kamu sudah terverifikasi, kamu akan nerima email yang memberitahukan bahwa kamu sudah bisa mulai belajar.
            </p>
            <div class="mt-4 rata-tengah">
                <div class="bag bag-4">
                        <a href="{{ route('user.listKelas') }}"><button class="lebar-70 oren">Lihat Kelas</button></a>
                </div>
                <div class="bag bag-2">&nbsp;</div>
                <div class="bag bag-4">
                    <a href="{{ route('user.cariKelas') }}"><button class="lebar-70 oren">Cari Kelas</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection