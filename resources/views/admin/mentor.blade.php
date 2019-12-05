@extends('layouts.dashboardAdmin')

@section('title', 'Mentor List | Belajar Ngeweb ID')

@section('head.dependencies')
<style>
    .popup .box { width: 100%; }
    .mentor {
        display: inline-block;
        vertical-align: top;
        width: 100%;
        margin-top: 80px;
    }
    .mentor .photo {
        height: 130px;
        width: 130px;
        display: inline-block;
        background-size: cover !important;
        background-position: center center;
        margin-top: -80px;
        border: 10px solid #fff;
    }
    #result { margin-top: 20px; }
    #result .user, #selected .user {
        cursor: pointer;
        display: inline-block;
    }
    #result .user[selected='yes'] { background: #2ecc71; }
</style>
@endsection

@section('content')
<div class="tinggi-75">
    <h1 class="ke-kiri">Mentor List</h1>
    <button class="ke-kanan oren" onclick="newMentor()"><i class="fas fa-plus"></i> &nbsp; Mentor Baru</button>
</div>
@if ($mentors->count() == 0)
    <h3>Tidak ada data</h3>
@else
    @foreach ($mentors as $mentor)
        <div class="bagi bagi-3 rata-tengah">
            <div class="wrap" style="margin: 2%;">
                <div class="mentor bg-putih rounded bayangan-5 rata-tengah">
                    <div class="wrap">
                        <div class="photo rounded-circle" style="background-image: url({{ asset('/storage/avatars/' . $mentor->photo) }})"></div>
                        <h2>{{ $mentor->name }}</h2>
                        <div class="row">
                            <div class="bagi bagi-2 mb-1">
                                <h3 class="mb-1">5</h3>
                                kelas
                            </div>
                            <div class="bagi bagi-2 mb-1">
                                <h3 class="mb-1">205</h3>
                                peserta
                            </div>
                        </div>
                        <a href="{{ route('admin.removeMentor', $mentor->id) }}">
                            <button class="merah mt-1 tinggi-50"><i class="fas fa-times"></i> &nbsp;remove from mentor</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<div class="bg"></div>
<div class="popupWrapper mt-5" id="newMentor">
    <div class="popup">
        <div class="wrap">
            <div class="tinggi-45">
                <h2 class="ke-kiri mt-0">Tambahkan mentor baru</h2>
                <div class="ke-kanan" onclick="hilangPopup('#newMentor')"><i class="fas fa-times"></i></div>
            </div>

            <form action="{{ route('admin.mentorAdd') }}" method="POST">
                {{ csrf_field() }}
                Selected :
                <div id="selected"></div>
                <input type="hidden" id="inputSelected" name="mentors">

                <input type="text" id="searchMentor" class="box lebar-100" oninput="searchUser(this.value)" placeholder="Cari nama...">
                <div id="result"></div>
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
    let selectedResult = []
    const newMentor = () => {
        munculPopup("#newMentor")
    }
    const searchUser = (q) => {
        if(q.split('').length < 3) {
            return false
        }
        let req = request('{{ route("api.searchUserNonMentor") }}', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                q: q
            })
        })
        .then(res => {
            parseResult(res)
        })
    }
    const runCreateElement = (res) => {
        createElement({
            el: "div",
            html: res.name,
            attribute: [
                ['class', 'user bg-oren rounded-circle p-1 pl-2 pr-2'],
                ['onclick', 'select(this)'],
                ['user_id', res.id],
                ['selected', "no"]
            ],
            createTo: "#result"
        })
    }
    const containsObject = (obj, lists) => {
        let ret = "false"
        lists.forEach(list => {
            if(list.id == obj.id) {
                ret = "true"
            }
        })
        return ret
    }
    const parseResult = (res) => {
        $("#result").tulis('')
        res.forEach(res => {
            let data = {id: res.id.toString(), name: res.name}
            if(containsObject(data, selectedResult) == "false") {
                runCreateElement(res)
            }
        })
    }
    const parseSelected = () => {
        $("#selected").tulis('')
        selectedResult.forEach(res => {
            createElement({
                el: "div",
                html: res.name,
                attribute: [
                    ['class', 'user bg-oren mt-1 rounded-circle p-1 pl-2 pr-2'],
                    ['onclick', 'removeSelected(this)'],
                    ['data', JSON.stringify(res)]
                ],
                createTo: "#selected"
            })
        })
        $("#inputSelected").isi(JSON.stringify(selectedResult))
    }
    const removeSelected = (that) => {
        let data = that.getAttribute('data')
        removeArray(selectedResult, data)
        parseSelected()
    }
    const select = (that) => {
        let userId = that.getAttribute('user_id')
        let userName = that.innerHTML
        let selected = that.getAttribute('selected')
        let data = {id: userId, name: userName}

        if(selected == 'no') {
            that.setAttribute('selected', 'yes')
            selectedResult.push(data)
        }else {
            that.setAttribute('selected', 'no')
            removeArray(selectedResult, data)
        }
        $("#result").tulis('')
        parseSelected()
    }
    tekan('Escape', () => {
        hilangPopup("#newMentor")
    })
</script>
@endsection