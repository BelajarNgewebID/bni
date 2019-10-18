@extends('layouts.dashboard')

@section('title', 'Dasbor')

@php
function bindStatus($status) {
    if($status == 0) {
        return "Diproses";
    }else if($status == 1) {
        return "Terkirim";
    }
}
@endphp

@section('content')
<h1>Permintaan Payout</h1>
<div class="content bg-putih rounded p-1 bayangan-5">
    <div class="wrap">
        @if ($payouts->count() == 0)
            <h3>Tidak ada data</h3>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nama kelas</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payouts as $item)
                        <tr>
                            <td>{{ $item->kelas->title }}</td>
                            <td>{{ $item->nominal }}</td>
                            <td>{{ bindStatus($item->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection