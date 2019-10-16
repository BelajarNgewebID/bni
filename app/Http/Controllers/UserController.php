<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \App\Http\Controllers\ClassController as ClassCtrl;
use \App\Http\Controllers\LearnController as LearnCtrl;
use \App\Http\Controllers\MaterialController as MaterialCtrl;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public static function me() {
        return Auth::guard('user')->user();
    }
    public static function update($id, $column, $value) {
        return User::find($id)->update([$column => $value]);
    }
    public function loginPage(Request $req) {
        $reto = $req->reto != "" ? $req->reto : "";
        return view('user.login')->with(['reto' => $reto]);
    }
    public function registerPage() {
        return view('user.register');
    }
    public function login(Request $req) {
        $reto = base64_decode($req->reto);
        $email = $req->email;
        $password = $req->password;

        $login = Auth::guard('user')->attempt(['email' => $email, 'password' => $password]);
        if(!$login) {
            return redirect()->route('user.loginPage')->withErrors(['Email / Password salah!']);
        }
        if($reto == "") {
            return redirect()->route('user.index');
        }else {
            return redirect($reto);
        }
    }
    public function logout() {
        Auth::guard('user')->logout();
        return redirect()->route('user.index');
    }
    public function register(Request $req) {
        $reg = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'photo' => 'default.jpg',
            'status' => 1,
            'is_mentor' => 0,
            'class_list' => '[]',
        ]);

        $showName = explode(" ", $req->name)[0];

        return redirect()->route('user.registerSuccess')->with(['showName' => $showName]);
    }
    public function registerSuccess() {
        $showName = Session::get('showName');
        return view('user.successRegister')->with(['showName' => $showName]);
    }
    public function indexPage() {
        $myData = $this->me();
        return view('index')->with(['myData' => $myData]);
    }
    public function listKelas() {
        $myData = $this->me();
        $myClass = ClassCtrl::mine($myData->id);
        return view('kelas')->with(['myData' => $myData, 'myClass' => $myClass]);
    }
    public function cariKelas(Request $req) {
        $myData = $this->me();
        $q = ClassCtrl::search($req->term);
        return view('cariKelas')->with(['datas' => $q, 'myData' => $myData, 'term' => $req->term]);
    }

    // pengajar
    public function dashboard() {
        return view('pengajar.dashboard');
    }
    public function kelas() {
        $myId = $this->me()->id;
        $classData = ClassCtrl::myClass($myId);
        return view('pengajar.kelas')->with(['classes' => $classData]);
    }
    public function createClass() {
        return view('pengajar.kelas.createClass');
    }
    public function manageMaterial($classId) {
        $materials = MaterialCtrl::getMaterialClass($classId);
        $classData = ClassCtrl::info($classId);
        return view('pengajar.kelas.material')->with([
            'materials' => $materials,
            'classData' => $classData,
        ]);
    }
    public function classSettings($classId) {
        $classData = ClassCtrl::info($classId);
        return view('pengajar.kelas.settings')->with([
            'classData' => $classData
        ]);
    }
    public function uploadMaterialPage($classId) {
        $classData = ClassCtrl::info($classId);
        return view('pengajar.kelas.uploadMaterial')->with(['classData' => $classData]);
    }
    public function classParticipant($classId) {
        $classData = ClassCtrl::info($classId);
        $learnerData = LearnCtrl::getLearner($classId);
        return view('pengajar.kelas.participant')->with([
            'classData' => $classData,
            'participants' => $learnerData,
        ]);
    }
}
