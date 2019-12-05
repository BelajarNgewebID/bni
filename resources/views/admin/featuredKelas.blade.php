@extends('layouts.dashboardAdmin')

@section('title', 'Featured Kelas | Belajar Ngeweb ID')

@section('head.dependencies')
<style>
    .popup .box { width: 100%; }
    .box[readonly] { background: #ecf0f1; }
    #result { margin-top: 20px; }
    #result .data, #selected .data {
        cursor: pointer;
        line-height: 46px;
        border-bottom: 1px solid #ddd;
    }
    .coverClass {
        height: 200px;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center center !important;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
</style>
@endsection

@section('content')
<div class="tinggi-75">
    <h1 class="ke-kiri">Featured Kelas</h1>
    <button class="ke-kanan oren" onclick="newClass()"><i class="fas fa-plus"></i> &nbsp; Tambahkan Kelas</button>
</div>
@if ($classes->count() == 0)
    <div class="bg-putih rounded bayangan-5 p-1">
        <div class="wrap">
            <h2>Tidak ada data</h2>
        </div>
    </div>
@else
    @foreach ($classes as $class)
        <div class="bagi bagi-3 rata-tengah">
            <div class="wrap" style="margin: 2%;">
                <div class="mentor bg-putih rounded bayangan-5 pb-1 rata-kiri">
                    <div class="coverClass" style="background: url({{ $class->kelas->cover_url }})"></div>
                    <div class="wrap">
                        <h3>{{ $class->kelas->title }}</h3>
                        <p>{{ $class->kelas->users->name }}</p>
                        <p>Until : {{ Carbon::parse($class->valid_until)->format('M d, Y') }}</p>
                        
                        <a href="{{ route('kelas.removeFeaturing', $class->id) }}">
                            <button class="merah lebar-100"><i class="fas fa-times"></i> &nbsp; remove from featured</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<div class="bg"></div>
<div class="popupWrapper" id="newClass">
    <div class="popup mt-5">
        <div class="wrap">
            <h3>Tambahkan Kelas :
                <div class="ke-kanan"><i class="fas fa-times"></i></div>
            </h3>
            <form action="{{ route('kelas.featuring') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="class_id" id="toFeatured" required>
                <input type="text" class="box" id="searchClassInput" placeholder="Cari nama kelas, id, atau mentor" oninput="searchClass(this.value)" required>
                <div id="result"></div>
                <div id="stepTwo" class="d-none">
                    Sampai :
                    <input type="date" name="until" class="box mt-1" required>
                </div>
                <div class="bag-tombol">
                    <button class="oren p-0">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    const newClass = () => {
        munculPopup("#newClass")
    }

    const searchClass = (that) => {
        if(that.split('').length < 3) {
            return false
        }
        let req = request('{{ route("api.searchClassForFeatured") }}', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                q: that
            })
        })
        .then(res => {
            parseResult(res)
        })
    }

    const parseResult = (datas) => {
        $("#result").tulis('')
        datas.forEach(res => {
            createElement({
                el: "div",
                html: res.title + ' (' + res.users.name + ')',
                attribute: [
                    ['class', 'data'],
                    ['onclick', 'select(this)'],
                    ['class_data', JSON.stringify(res)],
                ],
                createTo: "#result"
            })
        })
    }
    const select = (that) => {
        let data = JSON.parse(that.getAttribute('class_data'))
        $("#searchClassInput").isi(data.title + ' (' + data.users.name + ')')
        $("#searchClassInput").atribut('readonly', 'readonly')
        $("#result").tulis('')
        $("#stepTwo").muncul()

        $("#toFeatured").isi(data.id)
    }
</script>
@endsection