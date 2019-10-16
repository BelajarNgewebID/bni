@extends('layouts.dashboard')

@section('title', 'Kelas | Belajar Ngeweb ID')

@section('content')
<div class="lebar-100">
    <h1 class="d-inline-block">{{ $classData->title }}</h1>
</div>

@include('layouts.menuKelas')

<div class="row">
    <div class="content bg-putih rounded bayangan-5 p-1">
        <div class="wrap">
            <form action="{{ route('kelas.update', $classData->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="patch">
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="bg-merah-transparan p-2 mb-1 rounded">
                            {{ $err }}
                        </div>
                    @endforeach
                @endif
                <div>Nama kelas :</div>
                <input type="text" class="box mt-1" name="title" placeholder="Misal : Membuat API dengan Laravel" value="{{ $classData->title }}">
                <div class="mt-2">Deskripsi :</div>
                <textarea name="description" class="box mt-1" placeholder="Ceritakan apa yang akan dipelajari di kelas ini">{{ $classData->description }}</textarea>
                <div class="mt-2">Ganti Cover :</div>
                <input type="file" name="cover" class="box mt-1">
                <button class="oren mt-3">Buat!</button>
            </form>
        </div>
    </div>
    <div class="content bg-putih rounded mt-4 mb-4 bayangan-5 p-1">
        <div class="wrap">
            <form action="{{ route('kelas.delete', $classData->id) }}" method="POST" id="deleteClass">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
                <h2>Hapus kelas</h2>
                <p class="teks-transparan">Tindakan ini akan menghapus kelas beserta seluruh video materi yang ada dan tidak dapat dibatalkan</p>
                <input type="hidden" id="classNameToDelete" value="{{ $classData->title }}">
                <input type="text" class="box mb-2" oninput="tryDelete(this.value)" placeholder="Ketik nama kelas untuk melanjutkan">
                <button class="tbl bg-merah-transparan lebar-100" id="btnDelete" type="button"><i class="fas fa-trash"></i> &nbsp; Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let namaKelas = $("#classNameToDelete").isi()[0]
    let allowToDelete = 0

    $("#deleteClass")[0].onsubmit = (e) => {
        if(allowToDelete == 0) {
            e.preventDefault()
            return false
        }
    })

    function tryDelete(typed) {
        if(typed.toLowerCase() == namaKelas.toLowerCase()) {
            $("#btnDelete").atribut('type', 'submit')
            $("#btnDelete").atribut('class', 'tbl merah lebar-100')
        }else {
            $("#btnDelete").atribut('type', 'button')
            $("#btnDelete").atribut('class', 'tbl bg-merah-transparan lebar-100')
        }
    }
</script>
@endsection
