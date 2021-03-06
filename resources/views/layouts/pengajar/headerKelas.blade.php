@section('head.dependencies')
<style>
    .lebar-33 { width: 33.3%; }
    .navigation .active { color: #f15b2d;font-family: ProBold; }
</style>
@endsection

@php
    function toIdr($angka) {
        return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
@endphp

<div class="lebar-100">
    <h1 class="d-inline-block">{{ $classData->title }}</h1>
    <p class="teks-transparan">
        {{-- {{ dd($availableToPayout) }} --}}
        @if($availableToPayout->sum('to_pay') != 0)
            {{ toIdr($availableToPayout->sum('to_pay')) }} tersedia untuk diambil. 
            <a href="{{ route('payout.claim', $classData->id) }}">Tarik dana!</a>
        @endif
    </p>
</div>

<div class="row mt-2 mb navigation">
    <div class="bag lebar-33 rata-tengah">
        <a href="{{ route('kelas.material', $classData->id) }}">
            <div class="wrap bg-putih p-2 rounded bayangan-5 {{ (Route::currentRouteName() == 'kelas.material') ? 'active' : 'none' }}">
                <i class="fas fa-list"></i> &nbsp; Materi
            </div>
        </a>
    </div>
    <div class="bag lebar-33 rata-tengah">
        <a href="{{ route('kelas.peserta', $classData->id) }}">
            <div class="wrap bg-putih p-2 rounded bayangan-5 {{ (Route::currentRouteName() == 'kelas.peserta') ? 'active' : 'none' }}">
                <i class="fas fa-users"></i> &nbsp; Peserta
            </div>
        </a>
    </div>
    <div class="bag lebar-33 rata-tengah">
        <a href="{{ route('kelas.settings', $classData->id) }}">
            <div class="wrap bg-putih p-2 rounded bayangan-5 {{ (Route::currentRouteName() == 'kelas.settings') ? 'active' : 'none' }}">
                <i class="fas fa-cogs"></i> &nbsp; Settings
            </div>
        </a>
    </div>
</div>