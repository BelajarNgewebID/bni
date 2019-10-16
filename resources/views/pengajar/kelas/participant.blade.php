@extends('layouts.dashboard')

@section('title', 'Peserta '.$classData->title.' | Belajar Ngeweb ID')

@section('content')
<div class="lebar-100">
    <h1 class="d-inline-block">{{ $classData->title }}</h1>
</div>

@include('layouts.menuKelas')

<div class="row">
    <div class="content bg-putih rounded bayangan-5 p-1">
        <div class="wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>E-Mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection