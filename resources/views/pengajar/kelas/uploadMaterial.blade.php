@extends('layouts.dashboard')

@section('title', 'Upload Materi | Belajar Ngeweb ID')

@section('head.dependencies')
<style>
    /*  */
</style>
@endsection

@section('content')
<div class="lebar-100">
    <h1 class="d-inline-block">Upload Materi</h1>
</div>
<div class="row mt-2">
    <div class="bg-putih rounded bayangan-5 p-1 mb-5">
        <div class="wrap">
            <form action="{{ route('material.store', $classData->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="bg-merah-transparan p-2 mb-2 rounded">
                            {{ $err }}
                        </div>
                    @endforeach
                @endif
                <div>Title</div>
                <input type="text" class="box" name="title">
                <div class="mt-2">Price</div>
                <input type="hidden" name="price" value="0" id="price">
                <input type="text" class="box mt-1" id="priceDisplay" placeholder="Kosongkan saja jika kelas ini gratis">
                <div class="mt-2">File :</div>
                <input type="file" name="video" class="box tinggi-50 mt-1">
                <button class="lebar-100 oren mt-3">Upload!</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
function formatRupiah(angka, prefix){
    angka = angka.toString()
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
function toAngka(angka) {
	return parseInt(angka.replace(/,.*|[^0-9]/g, ''), 10);
}

function displayPrice() {
    let value = $("#price").isi().toString()
    let angka = formatRupiah(value, 'Rp. ')
    this.value = angka
    $("#priceDisplay").isi(this.value)
}
displayPrice()

$("#priceDisplay").di('ketik', function() {
    let value = this.value
    let angka = formatRupiah(value, 'Rp. ')
    this.value = angka
    $("#price").isi(toAngka(value))
})
</script>
@endsection