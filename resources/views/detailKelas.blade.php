@extends('layouts.user')

@section('title', $classData->title.' | Belajar Ngeweb ID')
@section('title.second', $classData->title)

@inject('ClassCtrl', 'App\Http\Controllers\ClassController')

@php
    function toIdr($angka) {
        return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
@endphp

@section('head.dependencies')
<style>
    body { background-color: #ecf0f1 !important; }
    .cover {
        height: 350px;
        background-size: cover !important;
        background-position: center center !important;
        width: 100%;
        border-radius: 6px;
    }
    img.profil {
        width: 50px;
        height: 50px;
    }
    .atas.khusus {
        background: rgba(0, 0, 0, 0.4);
    }
    .konten {
        position: absolute;
        top: 0px;left: 0px;right: 0px;
        height: 570px;
    }
    .konten .covers {
        height: 500px;
        background-size: cover !important;
        background-position: center center !important;
        filter: blur(2px);
    }
    .konten .tutupCover {
        margin-top: -500px;
        background: rgba(0, 0, 0, 0.4);
        position: relative;
        height: 500px;
    }
    .container {
        top: 500px;left: 0px;right: 0px;
    }
    .authorSection .foto {
        width: 150px;
        height: 150px;
        margin-top: -100px;
        border: 15px solid #fff;
    }
</style>
@endsection

@section('content')
<div class="konten">
    <div class="covers" style="background: url('{{ asset('storage/kelas/'.$ClassCtrl::slug($classData->title).'/'.$classData->cover) }}')">&nbsp;</div>
    <div class="tutupCover"></div>
</div>

<div class="container">
    <div class="authorSection bg-putih bayangan-5 pb-1 pt-2 pl-5 pr-5">
        <div class="bag bag-2">
            <img src="{{ asset('storage/avatars/'.$classData->users->photo) }}" class="foto rounded-circle">
        </div>
        <div class="bag bag-6">
            <h2 class="mt-1">{{ $classData->title }}</h2>
            <p class="teks-transparan mb-0">{{ $classData->users->name }}</p>
        </div>
        <div class="bag bag-2 rata-kanan">
            @if (Auth::guard('user')->check())
                @php
                    $actionRoute = $isJoined == 1 ? "learn.start" : "kelas.join";
                    $actionMethod = $isJoined == 1 ? "GET" : "POST";
                    $csrfField = $isJoined == 1 ? "" : csrf_field();
                    $textButton = $isJoined == 1 ? "Mulai Belajar" : "Gabung Kelas";
                @endphp
                {{-- <form action="{{ route($actionRoute, $classData->id) }}" method="{{ $actionMethod }}">
                    {{ $csrfField }}
                    <button class="mt-2 oren lebar-100">{{ $textButton }}</button>
                </form> --}}
            @else
                <div class="rata-tengah">
                    <p>Login dulu untuk mulai belajar</p>
                </div>
            @endif
        </div>
    </div>

    <div class="wrap">
        <div class="bag bag-5 bg-putih rounded bayangan-5">
            <div class="wrap">
                <p>{{ $classData->description }}</p>
            </div>
        </div>
        <div class="bag bag-5">
            <div class="wrap mt-0">
                <h2 class="teks-gelap mt-0">List Materi</h2>
                <p class="teks-transparan">Klik untuk pilih materi yang ingin kamu pelajari</p>
                @foreach ($materials as $item)
                    <div class="bg-putih rounded pointer bayangan-5 p-3 mb-2" onclick="selectMaterial(this)" material_id="{{ $item->id }}">
                        {{ $item->title }}
                        <br />
                        <div class="mt-1 teks-transparan">{{ toIdr($item->price) }}</div>
                    </div>
                @endforeach
                <form id="formOrder" action="{{ route('kelas.join', $classData->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="selectedMaterial" name="selectedMaterial">
                    <button type="button" id="btnBuy" class="lebar-100">Beli Materi</button>
                </form>
                <a href="{{ route('learn.start', [$classData->id, 1]) }}">
                    <button class="lebar-100 mt-2 primer">Lihat materi yang kamu punya</button>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/embo.js') }}"></script>
<script>
    let selectedMaterial = []
    function selectMaterial(that) {
        let selectedMaterialId = that.getAttribute('material_id')
        if(!inArray(selectedMaterialId, selectedMaterial)) {
            selectedMaterial.push(selectedMaterialId)
            that.style.border = '3px solid #f15b2d'
        }else {
            let i = 0
            selectedMaterial.forEach(res => {
                let iPP = i++
                if(res == selectedMaterialId) {
                    selectedMaterial.splice(iPP, 1)
                }
            })
            that.style.border = 'none'
        }

        if(selectedMaterial.length == 0) {
            $("#btnBuy").atribut("class", "lebar-100")
            $("#btnBuy").atribut("type", "button")
        }else {
            $("#btnBuy").atribut("type", "submit")
            $("#btnBuy").atribut("class", "oren lebar-100")
        }

        $("#selectedMaterial").isi(selectedMaterial)
    }
    window.onscroll = (e) => {
        scrollHandler(e)
    };
    function scrollHandler() {
        let scrolled = document.body.scrollTop || document.documentElement.scrollTop
        let classToNavbar = (scrolled > 120) ? "atas" : "atas khusus"
        document.querySelector(".atas").className = classToNavbar
    }
    scrollHandler()
</script>
@endsection