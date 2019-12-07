<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \App\Http\Controllers\ClassController as ClassCtrl;
use \App\Http\Controllers\LearnController as LearnCtrl;
use \App\Http\Controllers\EmailController as EmailCtrl;
use \App\Http\Controllers\PayoutController as PayoutCtrl;
use \App\Http\Controllers\MaterialController as MaterialCtrl;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public static function isLoggedIn() {
        return Auth::guard('user')->check();
    }
    public static function me() {
        return Auth::guard('user')->user();
    }
    public static function getMentor() {
        return User::where([
            ['is_mentor', 1]
        ])->get();
    }
    public function searchUserNonMentor(Request $req) {
        $q = $req->q;
        $user = User::where([
            ['name', 'LIKE', '%'.$q.'%'],
            ['is_mentor', 0]
        ])->get();
        return response()->json($user);
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
            'status' => 0,
            'is_mentor' => 0,
            'class_list' => '[]',
        ]);

        $mailVerification = EmailCtrl::completeRegistration([
            'name' => $req->name,
            'email' => $req->email,
        ]);

        $showName = explode(" ", $req->name)[0];

        return redirect()->route('user.registerSuccess')->with(['showName' => $showName]);
    }
    public function registerSuccess() {
        $showName = Session::get('showName');
        return view('user.successRegister')->with(['showName' => $showName]);
    }
    public function activate($email) {
        $email = base64_decode($email);
        $user = User::where('email', $email);
        if($user->get()->count() == 0) {
            return "404 User not found";
        }
        $activateUser = $user->update(['status' => 1]);
        $user = $user->first();
        $showName = explode(" ", $user->name)[0];
        return view('user.activate')->with([
            'showName' => $showName,
            'name' => $user->name,
        ]);
    }
    public function indexPage() {
        $myData = $this->me();
        $featuredClass = ClassCtrl::allFeatured();
        
        return view('index')->with([
            'myData' => $myData,
            'featuredClass' => $featuredClass,
        ]);
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
        $myId = $this->me()->id;
        $classTotal = ClassCtrl::allClass(['id','users_joined']);
        $myPopularClass = ClassCtrl::myPopularClass($myId)->limit(5)->get();
        $totalParticipant = $classTotal->sum('users_joined');
        $revenue = LearnCtrl::get([
            ['is_payout', 0],
            ['status', 1]
        ])->get('to_pay')->sum('to_pay');
        
        return view('pengajar.dashboard')->with([
            'classTotal' => $classTotal,
            'myPopularClass' => $myPopularClass,
            'totalParticipant' => $totalParticipant,
            'revenue' => $revenue,
        ]);
    }
    public function kelas() {
        $myId = $this->me()->id;
        $classData = ClassCtrl::myClass($myId);
        return view('pengajar.kelas')->with(['classes' => $classData]);
    }
    public function createClass() {
        return view('pengajar.kelas.createClass');
    }
    public function getSaldo($classId) {
        $materials = MaterialCtrl::getMaterialClass($classId);
        return $materials->count() > 0 ? LearnCtrl::getAvailableToPayout($classId) : collect([['to_pay' => 0]]);
    }
    public function manageMaterial($classId) {
        $materials = MaterialCtrl::getMaterialClass($classId);
        $classData = ClassCtrl::info($classId);
        $availableToPayout = $this->getSaldo($classId);

        return view('pengajar.kelas.material')->with([
            'materials' => $materials,
            'classData' => $classData,
            'availableToPayout' => $availableToPayout,
        ]);
    }
    public function classSettings($classId) {
        $classData = ClassCtrl::info($classId);
        $availableToPayout = $this->getSaldo($classId);

        return view('pengajar.kelas.settings')->with([
            'classData' => $classData,
            'availableToPayout' => $availableToPayout
        ]);
    }
    public function uploadMaterialPage($classId) {
        $classData = ClassCtrl::info($classId);
        return view('pengajar.kelas.uploadMaterial')->with(['classData' => $classData]);
    }
    public function classParticipant($classId) {
        $classData = ClassCtrl::info($classId);
        $learnerData = LearnCtrl::getLearner($classId);
        $availableToPayout = $this->getSaldo($classId);

        return view('pengajar.kelas.participant')->with([
            'classData' => $classData,
            'participants' => $learnerData,
            'availableToPayout' => $availableToPayout,
        ]);
    }
    public function earning() {
        $myData = $this->me();
        $payouts = PayoutCtrl::mine($myData->id);

        return view('pengajar.earning')->with([
            'myData' => $myData,
            'payouts' => $payouts,
        ]);
    }

    public function settingsPage() {
        $myData = $this->me();
        return view('user.settings')->with([
            'myData' => $myData
        ]);
    }
    public function addAsMentor(Request $req) {
        $mentors = json_decode($req->mentors);
        foreach($mentors as $mentor) {
            $beingMentor = $this->update($mentor->id, 'is_mentor', 1);
        }
        return redirect()->route('admin.mentor');
    }
    public function removeMentor($id) {
        $removeMentorStatus = $this->update($id, 'is_mentor', 0);
        return redirect()->route('admin.mentor');
    }
    public function getExtension($fileName) {
        $p = explode(".", $fileName);
        return $p[count($p) - 1];
    }
    public function settingsPersonal(Request $req) {
        $myData = $this->me();
        $myId = $myData->id;

        $getUserData = User::find($myId);
        $updateData = $getUserData->update([
            'name' => $req->name,
            'email' => $req->email,
        ]);

        // handling profile picture
        $photo = $req->file('photo');
        if($photo != "") {
            $fileName = $photo->getClientOriginalName();
            $extension = $this->getExtension($fileName);
            $timeNow = time();
            $newFileName = $myData->id."-".$timeNow.".".$extension;

            $upload = $photo->storeAs('public/avatars/', $newFileName);
            $updateProfilePict = $getUserData->update([
                'photo' => $newFileName
            ]);
        }

        return redirect()->route('user.settings');
    }
}
