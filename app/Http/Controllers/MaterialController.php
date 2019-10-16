<?php

namespace App\Http\Controllers;

use Storage;
use App\Material;
use App\Learn;
use Illuminate\Http\Request;
use App\Http\Controllers\ClassController as ClassCtrl;

class MaterialController extends Controller
{
    public static function get($id) {
        return Material::find($id);
    }
    public static function getFirst($classId) {
        return Material::where('class_id', $classId)->orderBy('created_at', 'ASC')->first();
    }
    public static function getMaterialClass($classId) {
        return Material::where('class_id', $classId)->orderBy('updated_at')->get();
    }
    public static function mine($user, $opt = NULL) {
        $statusFilter = array_key_exists('status', $opt) ? ['status', $opt['status']] : ['to_pay', '!=', 'not this title'];
        $userMaterial = Learn::where([
            ['user_id', $user->id],
            $statusFilter,
        ])->with('material');

        if(array_key_exists('column', $opt)) {
            return $userMaterial->get($opt['column']);
        }else {
            return $userMaterial->get();
        }
    }
    public static function getAvailableToBuy($user, $classId) {
        $userMaterial = self::mine($user, [
            'column' => 'material_id',
        ]);
        $userMaterial = json_decode($userMaterial, true);

        $getClassMaterial = Material::where([
            ['class_id', $classId],
        ])
        ->whereNotIn('id', $userMaterial)
        ->get();
        
        return $getClassMaterial;
    }
    public function store($classId, Request $req) {
        $validateData = $this->validate($req, [
            'video' => 'required|mimes:mp4',
            'title' => 'required'
        ]);

        $classData = ClassCtrl::info($classId);

        $video = $req->file('video');
        $videoFileName = str_replace(" ", "", $video->getClientOriginalName());

        $material = Material::create([
            'class_id' => $classId,
            'title' => $req->title,
            'video' => $videoFileName,
            'price' => $req->price,
        ]);
        
        $sluggedClassName = ClassCtrl::slug($classData->title);
        $video->storeAs('public/kelas/'.$sluggedClassName.'/', $videoFileName);

        return redirect()->route('kelas.material', $classId);
    }
    public function delete($id, Request $req) {
        $classId = '';
        $material = Material::find($id);
        $classId = $material->class_id;

        $deleteFile = Storage::delete('public/videos/'.$material->video);
        $material->delete();

        return redirect()->route('kelas.material', $classId);
    }
}
