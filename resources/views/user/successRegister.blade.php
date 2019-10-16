@extends('layouts.auth')

@section('title', 'Berhasil mendaftar')

@section('content')
<style>
    .iconCheck {
        width: 100px;
        line-height: 100px;
        font-size: 45px;
    }
    .content { line-height: 32px; }
    @media (max-width: 480px) {
        .container { margin-top: 10px; }
        .container > div { width: 90%; }
    }
</style>
<div class="mt-5 rata-tengah container">
    <div class="lebar-35 d-inline-block rata-kiri mt-5">
        <div class="rata-tengah mb-3">
            <div class="rounded-circle bg-hijau rata-tengah d-inline-block iconCheck">
                <i class="fas fa-check"></i>
            </div>
        </div>
        <div class="bg-putih bayangan-5 rounded p-1">
            <div class="wrap">
                <p class="mt-3 content">
                    <b>Selamat, {{ $showName }}!</b> Kamu telah terdaftar sebagai member di Belajar Ngeweb ID. Tapi sebelum kamu bisa mulai belajar, kamu perlu mengaktifkan akun kamu dulu. Caranya sudah dikirim ke email kamu. Kalau ga ketemu, coba cek folder spam barangkali ada di situ.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection