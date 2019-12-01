@extends('layouts.user')

@section('title', $classData->title . ' di Belajar Ngeweb ID')
@section('title.second', $classData->title)

@section('head.dependencies')
<link rel="stylesheet" href="{{ asset('plugins/plyr/dist/plyr.css') }}">
<style>
    body { background-color: #ecf0f1 !important; }

    .listMateri {
        overflow: auto;
    }
    .listMateri li {
        padding: 20px 0px;
        list-style: none;
        border-bottom: 1px solid #ddd;
    }
    li.active { color: #f15b2d;font-family: ProBold; }
    .player {
        position: absolute;
        top: 80px;left: 0px;right: 0px;
        height: 200px;
        text-align: center;
        background-color: #000;
    }
    #player { width: 70%; }
    
    .content {
        position: absolute;
        top: 92%;left: 0px;right: 0px;
    }
</style>
@endsection

@section('content')
<div class="player">
    <video id="player" playsinline controls autoplay>
        <source src="{{ route('stream.video', [$classData->id, $material->video]) }}" type="video/mp4" />
    </video>
</div>

<div class="content">
    <div class="wrap">
        <div class="bagi lebar-65 bayangan-5">
            <div class="bg-putih rounded p-1">
                <div class="wrap">
                    <h2>{{ $material->title }}</h2>
                </div>
            </div>
        </div>
        <div class="bagi lebar-5"></div>
        <div class="bagi lebar-30 bayangan-5">
            <div class="bg-putih rounded p-1">
                <div class="wrap">
                    <div class="listMateri">
                        <h3>Materi Kelas</h3>
                        @foreach ($materials as $item)
                            <a href="{{ route('learn.start', [$classData->id, $item->material->id]) }}">
                                <li class="{{ ($material->id == $item->material->id) ? 'active' : '' }}">{{ $item->material->title }}</li>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="ss">
        <video id="player" playsinline controls autoplay>
            <source src="{{ route('stream.video', [$classData->id, $material->video]) }}" type="video/mp4" />
        </video>
        <div class="bg-putih rounded bayangan-5 p-1 mt-3">
            <div class="wrap">
                <h3>{{ $material->title }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="playLists bg-putih rounded bayangan-5">
    <div class="wrap">
        <h2>Materi Belajar</h2>
        <div class="listMateri">
            @foreach ($materials as $item)
                <a href="{{ route('learn.start', [$classData->id, $item->material->id]) }}">
                    <li class="{{ ($material->id == $item->material->id) ? 'active' : '' }}">{{ $item->material->title }}</li>
                </a>
            @endforeach
        </div>
    </div>
</div> --}}

<script src="{{ asset('plugins/plyr/dist/plyr.min.js') }}"></script>
<script>
    const player = new Plyr("#player")
</script>

@endsection