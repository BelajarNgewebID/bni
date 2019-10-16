<?php

namespace App\Http\Controllers;

use Storage;
use App\Kelas;
use App\Learn;
use App\Material;
use Illuminate\Http\Request;
use \App\Http\Controllers\UserController as UserCtrl;
use \App\Http\Controllers\InvoiceController as InvCtrl;
use \App\Http\Controllers\MaterialController as MateriCtrl;

class ClassController extends Controller
{
    public static function slug($title) {
        $cek = strpos($title, "-");
		if($cek > 0) {
			$res = implode(" ", explode("-", $title));
		}else {
			$res = implode("-", explode(" ", $title));
			$res = strtolower($res);
		}
		return $res;
    }
    // user
    public static function mine($myId) {
        return Learn::where([
            ['status', 1],
            ['user_id', $myId]
        ])->with('kelas.users')->get();
    }
    // pengajar
    public static function myClass($userId) {
        return Kelas::where('user_id', $userId)->get();
    }
    public static function info($classId) {
        return Kelas::where('id', $classId)->first();
    }
    public function store(Request $req) {
        $myData = UserCtrl::me();

        $validateData = $this->validate($req, [
            'cover' => 'image|required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $cover = $req->file('cover');
        $coverFileName = $cover->getClientOriginalName();

        $create = Kelas::create([
            'user_id' => $myData->id,
            'title' => $req->title,
            'description' => $req->description,
            'cover' => $coverFileNamestatic ,
            'tag' => ''
        ]);

        $titleSlug = $this->slug($req->title);

        // create directory for storing material
        $createDir = Storage::disk('kelas')->makeDirectory($titleSlug);

        $cover->storeAs('public/kelas/'.$titleSlug.'/', $coverFileName);

        return redirect()->route('pengajar.kelas');
    }
    public function update($id, Request $req) {
        $validateData = $this->validate($req, [
            'cover' => 'image',
            'title' => 'required',
            'description' => 'required',
        ]);

        $cover = $req->file('cover');

        $kelas = Kelas::find($id);
        $kelas->title = $req->title;
        $kelas->description = $req->description;
        if($cover != "") {
            $coverFileName = $cover->getClientOriginalName();
            $kelas->cover = $coverFileName;

            $titleSlug = $this->slug($req->title);
            $cover->storeAs('public/kelas/'.$titleSlug.'/', $coverFileName);
        }
        $kelas->save();

        return redirect()->route('kelas.settings', $id);
    }
    public function delete($id) {
        $class = Kelas::find($id);
        $class->delete();
        
        return "200";
    }
    public static function search($term) {
        $myData = UserCtrl::me();
        $notMine = ['user_id', 'LIKE', '%%'];
        if($myData != "") {
            $myId = $myData;
            $notMine = ['user_id', '!=', $myId];
        }
        return Kelas::where([
            ['title', 'LIKE', '%'.$term.'%'],
            $notMine,
        ])->with('users')->get();
    }
    public function isJoined($userId, $classId) {
        $get = Learn::where([
            ['class_id', $classId],
            ['user_id', $userId],
        ])->count();

        return $get == 0 ? 0 : 1;
    }
    public function detail($id) {
        $myData = UserCtrl::me();
        $myClasses = explode(",", $myData->class_list);

        $kelas = Kelas::where('id', $id)->with('users')->first();
        if(in_array($id, $myClasses)) {
            $materials = MateriCtrl::getAvailableToBuy($myData, $id);
        }else {
            $materials = MateriCtrl::getMaterialClass($id);
        }

        if($myData == "") {
            // belum login
            $isJoined = 0;
        }else {
            $isJoined = $this->isJoined($myData->id, $kelas->id);
        }
        $isPaid = "";
        if($isJoined != 0) {
            $isPaid = InvCtrl::isPaid($myData->id, $kelas->id);
        }

        return view('detailKelas')->with([
            'classData' => $kelas,
            'myData' => $myData,
            'materials' => $materials,
            'isJoined' => $isJoined,
            'isPaid' => $isPaid,
        ]);
    }
    public function isHaveClass($myClass, $classId) {
        $myClass = explode(",", $myClass);

        return (in_array($classId, $myClass)) ? true : false;
    }
    public function updateMyClass($params) {
        $myData = $params['userData'];
        $classId = $params['classId'];

        $userClasses = $myData->class_list;
        if($userClasses == "") {
            $updateMyClass = UserCtrl::update($myData->id, "class_list", $classId);
        }else {
            if(!$this->isHaveClass($userClasses, $classId)) {
                $myClass = $userClasses.",".$classId;
                $updateMyClass = UserCtrl::update($myData->id, "class_list", $myClass);
            }
        }
    }
    public function join($id, Request $req) {
        $classId = $id;
        $myData = UserCtrl::me();
        $selectedMaterial = explode(",", $req->selectedMaterial);

        $this->updateMyClass([
            'userData' => $myData,
            'classId' => $classId,
        ]);

        foreach($selectedMaterial as $key => $value) {
            $material = Material::find($value);
            $status = $material->price > 0 ? 0 : 1;

            $join = Learn::create([
                'user_id' => $myData->id,
                'material_id' => $value,
                'class_id' => $classId,
                'to_pay' => $material->price,
                'status' => $status,
            ]);
        }

        return redirect()->route('invoice');
    }
    public function joinLama($id, Request $req) {
        $classId = $id;
        $myData = UserCtrl::me();
        $myId = $myData->id;
        $classData = $this->info($classId);
        $status = $classData->price > 0 ? 0 : 1;

        $joining = Learn::create([
            'user_id' => $myId,
            'class_id' => $classId,
            'status' => $status,
        ]);
        
        return redirect()->route('invoice');
    }
}
