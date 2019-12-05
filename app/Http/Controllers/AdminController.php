<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\User;
use App\Kelas;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \App\Http\Controllers\UserController as UserCtrl;
use \App\Http\Controllers\LearnController as LearnCtrl;
use \App\Http\Controllers\ClassController as ClassCtrl;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function loginPage() {
        return view('admin.login');
    }
    public function login(Request $req) {
        $email = $req->email;
        $password = $req->password;

        $login = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
        if(!$login) {
            return redirect()->route('admin.loginPage')->withErrors(['Email / Password salah!']);
        }

        return redirect()->route('admin.dashboard');
    }
    public function dashboard() {
        $totalClass = Kelas::all(['id'])->count();
        $totalMaterial = Material::all(['id'])->count();
        $totalParticipant = User::where([
            ['is_mentor', '!=', 1],
            ['class_list', '!=', '']
        ])->get('id')->count();

        return view('admin.dashboard')->with([
            'totalClass' => $totalClass,
            'totalMaterial' => $totalMaterial,
            'totalParticipant' => $totalParticipant
        ]);
    }
    public function invoice() {
        $data = LearnCtrl::getUnconfirm();
        return view('admin.invoice')->with(['datas' => $data]);
    }
    public function mentor() {
        $mentors = UserCtrl::getMentor();
        return view('admin.mentor')->with([
            'mentors' => $mentors
        ]);
    }
    public function kelas(Request $req) {
        $q = $req->q;
        if($q == "") {
            $classes = Kelas::with('users')->get();
        }else {
            $classes = Kelas::where([
                ['title', 'LIKE', '%'.$q.'%']
            ])->with('users')->get();
        }
        return view('admin.kelas')->with([
            'classes' => $classes,
            'q' => $q
        ]);
    }
    public function featuredKelas() {
        $classes = ClassCtrl::allFeatured();

        // bind and slug title

        return view('admin.featuredKelas')->with([
            'classes' => $classes
        ]);
    }
}
