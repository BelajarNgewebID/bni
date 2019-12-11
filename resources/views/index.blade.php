@extends('layouts.user')

@section('title', 'Belajar Ngeweb ID')
@section('title.second', 'Belajar Ngeweb ID')

@section('head.dependencies')

@endsection

@section('content')
<div class="container">
    <div class="bag bag-5">
        <h1>Welkam!</h1>
        <h2 class="mb-5 title index">Ada tutorial khusus buat kamu di sebelah kanan</h2>
        <form action="{{ route('user.cariKelas') }}">
            <div class="bag bag-7">
                <input type="text" class="box-2" name="term" placeholder="Atau cari sendiri tutorial favoritmu...">
            </div>
            <div class="bag bag-1">&nbsp;</div>
            <div class="bag bag-2">
                <button class="oren lebar-100">Cari</button>
            </div>
        </form>
    </div>
    <div class="bag bag-1"></div>
    <input type="hidden" id="featuredClass" value="{{ $featuredClass }}">
    <div class="bag bag-4 featured">
        @foreach ($featuredClass as $class)
            <a href="{{ route('kelas.detail', $class->class_id) }}">
                <div class="slideshow">
                    <div class="thumbnail" style="background: url({{ $class->kelas->cover_url }})"></div>
                    <div class="wrap">
                        <h3>{{ $class->kelas->title }}</h3>
                        <p class="text-muted author">
                            <img src="{{ asset('storage/avatars/'.$class->kelas->users->photo) }}" class="fotoProfilKecil ke-kiri mr-2">
                            oleh <b>{{ $class->kelas->users->name }}</b>
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

@section('javascript')
<script>
class Slider {
    constructor(props) {
        this.el = document.querySelectorAll(props.el)
        this.index = 0

        this.hideAll(this.index)
        this.counting()
    }
    counting() {
        setInterval(() => {
            if(this.index == this.el.length - 1) {
                this.index = 0
            }else {
                this.index += 1
            }

            this.hideAll(this.index)
        }, 5000)
    }
    hideAll(except) {
        let i = 0
        this.el.forEach(el => {
            let iPP = i++
            el.setAttribute('index', iPP)
            el.style.display = "none"
        })

        this.el[except].style.display = "block"
    }
}

let slider = new Slider({
    el: '.slideshow'
})

let featuredClasses = JSON.parse($("#featuredClass").isi()[0])
featuredClasses.forEach(featuredClass => {
    console.log(featuredClass)
})
</script>
@endsection