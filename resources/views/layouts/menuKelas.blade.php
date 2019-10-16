@section('head.dependencies')
<style>
    .lebar-33 { width: 33.3%; }
    .navigation .active { color: #f15b2d;font-family: ProBold; }
</style>
@endsection

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