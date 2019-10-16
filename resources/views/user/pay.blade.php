@extends('layouts.user')

@section('title', 'Bayar Tagihan | Belajar Ngeweb ID')
@section('title.second', 'Bayar Tagihan')

@php
    function toIdr($angka) {
        return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
@endphp

@section('content')
<div class="container">
    <div class="rata-tengah">
        <div class="rata-kiri d-inline-block lebar-60">
            <div class="bg-putih rounded p-1">
                <div class="wrap">
                    <span class="teks-transparan">Tagihan untuk :</span>
                    <h2>{{ $invoice->kelas->title }}</h2>
                    <span class="teks-transparan">{{ toIdr($invoice->to_pay) }}</span>
                    <form action="{{ route('invoice.bayar.action', $invoice->id) }}" method="POST" class="mt-3" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p>Upload bukti transfer kamu :</p>
                        <input type="file" class="box tinggi-40" name="evidence">
                        @if ($errors->count() != 0)
                            @foreach ($errors->all() as $err)
                                <div class="bg-merah-transparan mt-2 rounded p-2">
                                    {{ $err }}
                                </div>
                            @endforeach
                        @endif
                        <button class="oren lebar-100 mt-2">Upload!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection