@extends('layouts.dashboardAdmin')

@section('title', 'Accept Invoice | Belajar Ngeweb ID')

@section('content')
<div class="bg-putih rounded bayangan-5 p-1 mt-3">
    <div class="wrap">
        <table>
            <thead>
                <tr>
                    <th>InvID</th>
                    <th>Nama</th>
                    <th>Bukti</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            {{-- <img src="{{ asset('storage/evidences/'.$item->evidence) }}" alt=""> --}}
                            <a href="{{ asset('storage/evidences/'.$item->evidence) }}" class="teks-oren" target="_blank">
                                <i class="fas fa-image"></i> &nbsp; Lihat
                            </a>
                        </td>
                        <td class="rata-tengah lebar-20">
                            <a href="{{ route('admin.invoice.accept', $item->id) }}" class="teks-hijau"><i class="fas fa-check"></i></a>
                            &nbsp; &nbsp;
                            <a href="{{ route('admin.invoice.decline', $item->id) }}" class="teks-merah"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection