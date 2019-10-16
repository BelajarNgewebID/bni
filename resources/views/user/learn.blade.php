@extends('layouts.user')

@section('title', $classData->title . ' di Belajar Ngeweb ID')
@section('title.second', $classData->title)

@section('head.dependencies')
<link rel="stylesheet" href="{{ asset('plugins/plyr/dist/plyr.css') }}">
<style>
    body { background-color: #ecf0f1 !important; }
    .playLists {
        position: fixed;
        top: 145px;right: 5%;
        width: 30%;
    }
    .playLists a { text-decoration: none;color: #444; }
    .listMateri {
        height: 400px;
        overflow: auto;
    }
    .listMateri li {
        padding: 20px 0px;
        list-style: none;
        border-bottom: 1px solid #ddd;
    }
    .videos { height: 400px; }
    #player { width: 100%; }
    li.active { color: #f15b2d;font-family: ProBold; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="bag bag-6">
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
</div>

<script src="{{ asset('plugins/plyr/dist/plyr.min.js') }}"></script>
<script>
    const player = new Plyr("#player")
</script>

@endsection