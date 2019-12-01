@extends('layouts.dashboard')

@section('title', 'Dasbor')

@section('head.dependencies')
<style>
    #popularClass {
        padding: 0;
    }
    #popularClass li {
        list-style: none;
        line-height: 25px;
        padding: 10px 0px;
        border-bottom: 1px solid #ddd;
    }
    td,tr {
        padding: 10px 0px !important;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="bagi bagi-3">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 p-1 ">
                <div class="wrap">
                    <h2>10</h2>
                    kelas
                </div>
            </div>
        </div>
    </div>
    <div class="bagi bagi-3">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 p-1 ">
                <div class="wrap">
                    <h2>2384</h2>
                    peserta
                </div>
            </div>
        </div>
    </div>
    <div class="bagi bagi-3">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 p-1 ">
                <div class="wrap">
                    <h2>Rp 500.000</h2>
                    penghasilan
                </div>
            </div>
        </div>
    </div>
    <div class="bagi lebar-30">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 p-1">
                <div class="wrap">
                    <h3>Peserta Terbaru</h3>
                    <ul id="popularClass">
                        <li>Riyan Satria</li>
                        <li>John Doe</li>
                        <li>John</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bagi lebar-70">
        <div class="wrap">
            <div class="bg-putih rounded bayangan-5 p-1">
                <div class="wrap">
                    <h3>Kelas paling populer</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td>Menjadi Android Developer Expert</td>
                                <td style="width: 25%">520 peserta</td>
                            </tr>
                            <tr>
                                <td>Menjadi Android Developer Expert yang Berguna bagi nusa dan bangsa</td>
                                <td>50 peserta</td>
                            </tr>
                            <tr>
                                <td>Menjadi Android Developer Expert</td>
                                <td>50 peserta</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('pengajar.createClass') }}">
                        <button class="primer mt-2 lebar-100">Buat kelas baru</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection