@extends('layouts.auth')

@section('title', 'Buat Akun')

@section('content')
<style>
    @media (max-width: 480px) {
        .container > div { width: 95%; }
    }
</style>
<div class="mt-4 rata-tengah container mb-5" id="app">
    <div class="lebar-35 d-inline-block rata-kiri">
        <h1>Buat Akun</h1>
        <div class="bg-putih bayangan-5 rounded p-1">
            <form action="{{ route('user.register') }}" method="POST" class="wrap" @submit="submitForm">
                {{ csrf_field() }}
                <div>Nama :</div>
                <input type="text" class="box" name="name" @input="this.typing" v-model="name">
                <div class="mt-3">E-mail :</div>
                <input type="email" class="box" name="email" @input="this.typing" v-model="email">
                <div class="mt-3">Password :</div>
                <input type="password" class="box" name="password" v-model="pass" @input="this.typing">
                <div class="mt-3">Ulangi Password :</div>
                <input type="password" class="box" name="password_confirmation" @input="this.typing" v-model="rePass">
                <div v-if="verifyRePass == 0">
                    <div class="bg-merah-transparan p-2 mb-3 rounded mt-3">
                        Password kedua tidak sama
                    </div>
                </div>
                <div class="mt-3">
                    <button v-if="buttonActive == 1" class="oren lebar-100">Mendaftar</button>
                    <button v-else-if="buttonActive == 0" type="button" class="lebar-100">Mendaftar</button>
                </div>
            </form>
            <div class="mt-3 mb-2 rata-tengah">
                sudah punya akun? <a href="{{ route('user.loginPage') }}" class="teks-oren">login</a> aja
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/vue.js') }}"></script>
<script>
    let app = new Vue({
        el: '#app',
        data: {
            name: '',
            email: '',
            pass: '',
            rePass: '',
            verifyRePass: 2,
            buttonActive: 0,
        },
        methods: {
            submitForm(e) {
                if(this.buttonActive != 1) {
                    e.preventDefault()
                    return false
                }
            },
            typing(e) {
                let typed = e.currentTarget.value
                let name = e.currentTarget.name
                if(name == "password_confirmation") {
                    this.rePassword(typed)
                }

                if(this.name != '' && this.email != '' && this.pass != '' && this.rePass != '' && this.verifyRePass == 1) {
                    this.buttonActive = 1
                }
            },
            rePassword(pass) {
                this.verifyRePass = pass == this.pass ? 1 : 0
            }
        }
    })
</script>
@endsection