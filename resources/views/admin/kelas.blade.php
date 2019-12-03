@extends('layouts.dashboardAdmin')

@section('title', 'List Kelas | Belajar Ngeweb ID')

@section('content')
<div class="tinggi-80 mt-1">
    <h1 class="ke-kiri mt-1">List Kelas</h1>
    <form action="{{ route('admin.kelas') }}" class="ke-kanan lebar-50">
        <input type="text" class="box" name="q" placeholder="Cari kelas..." value="{{ $q }}">
    </form>
</div>
<div class="bg-putih rounded bayangan-5 p-1">
    <div class="wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama kelas</th>
                    <th>oleh</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->title }}</td>
                        <td>{{ $class->users->name }}</td>
                        <td>
                            <a href="{{ route('kelas.delete', $class->id) }}"><i class="fas fa-trash teks-merah"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection