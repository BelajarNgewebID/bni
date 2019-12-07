@extends('layouts.user')

@section('title', 'Settings | Belajar Ngeweb ID')
@section('title.second', 'Settings')

@section('content')
<div class="rata-tengah mt-5" style="margin-top: 90px;">
    <div class="d-inline-block mt-2 lebar-50 rata-kiri">
        <h1>Info Personal</h1>
        <div class="bg-putih rounded p-1">
            <div class="wrap">
                <form action="{{ route('user.settings.personal') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    Nama kamu :
                    <input type="text" class="box" name="name" required value="{{ $myData->name }}">
                    <div class="mt-2">Email :</div>
                    <input type="email" class="box" name="email" required value="{{ $myData->email }}">
                    <div class="mt-2">Foto : <span class="teks-transparan">(biarin kalau ga ganti)</span></div>
                    <input type="file" name="photo" class="box mt-1">
                    <button class="oren lebar-100 mt-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection