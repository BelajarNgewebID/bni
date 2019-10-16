<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \App\Http\Controllers\LearnController as LearnCtrl;

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
        return view('admin.dashboard');
    }
    public function invoice() {
        $data = LearnCtrl::getUnconfirm();
        return view('admin.invoice')->with(['datas' => $data]);
    }
}
