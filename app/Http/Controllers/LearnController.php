<?php

namespace App\Http\Controllers;

use Storage;
use App\Learn;
use Illuminate\Http\Request;
use \App\Http\Controllers\StreamController as Stream;
use \App\Http\Controllers\UserController as UserCtrl;
use \App\Http\Controllers\MaterialController as MaterialCtrl;
use \App\Http\Controllers\ClassController as ClassCtrl;
use \App\Http\Controllers\InvoiceController as InvCtrl;

class LearnController extends Controller
{
    public static function getAvailableToPayout($classId, $toGet = NULL) {
        if($toGet == null) {
            $toGet = ['id','to_pay'];
        }
        $learn = Learn::where([
            ['class_id', $classId],
            ['is_payout', 0]
        ])->get($toGet);
        return $learn;
    }
    public static function get($filter = NULL) {
        $data = $filter == NULL ? Learn::all() : Learn::where($filter);
        return $data;
    }
    public static function getUnconfirm() {
        $data = Learn::where([
            ['status', 2]
        ])->with('user')->get();
        return $data;
    }
    public static function getLearner($classId) {
        $data = Learn::where([
            ['class_id', $classId],
            ['status', 1]
        ])
        ->groupBy('user_id')
        ->with('user')->get();
        return $data;
    }
    public function redirectToFirstMaterial($classId, $firstMaterial) {
        return redirect()->route('learn.start', ['classId' => $classId, 'materialId' => $firstMaterial]);
    }
    public function index($classId, $materialId = NULL) {
        $myData = UserCtrl::me();
        $isPaid = InvCtrl::isPaid($myData->id, $classId);
        $classData = ClassCtrl::info($classId);
        $getMaterials = MaterialCtrl::mine($myData, [
            'status' => 1,
        ], $classId);

        $currentMaterial = MaterialCtrl::get($materialId);
        $firstMaterial = $getMaterials[0]->material->id;

        // cek apakah materi yang diminta dimiliki atau tidak
        $materials = json_decode($getMaterials, true);
        foreach($materials as $material) {
            $myMaterialId[] = $material['material_id'];
        }
        $currentMaterialArr = json_decode($currentMaterial, true);
        if(!in_array($currentMaterialArr['id'], $myMaterialId)) {
            // jika tidak ada
            return $this->redirectToFirstMaterial($classId, $firstMaterial);
        }

        if($classData->price > 0) {
            if($isPaid == 0) {
                return redirect()->route('invoice');
            }
        }

        if($currentMaterial == "") {
            return $this->redirectToFirstMaterial($classId, $firstMaterial);
        }

        return view('user.learn')->with([
            'myData' => $myData,
            'materials' => $getMaterials,
            'material' => $currentMaterial,
            'classData' => $classData,
        ]);
    }
    public function streamFiles($path) {
        $videoPath = base64_decode($path);
        $stream = new Stream;
        $stream->setPath($videoPath);
        $stream->start();
    }
    // Provide a streaming file with support for scrubbing
	public function stream($classId, $filename) {
        $classData = ClassCtrl::info($classId);
        $slugName = ClassCtrl::slug($classData->title);

        $videoDir = base_path('storage/app/public/kelas/'.$slugName);
        $videoPath = $videoDir."/".$filename;

        $stream = new \App\Http\VideoStream($videoPath);
        return response()->stream(function() use ($stream) {
            $stream->start();
        });
    }
    public static function update($learnId, $toUpdate) {
        return Learn::find($learnId)->update($toUpdate);
    }
}
