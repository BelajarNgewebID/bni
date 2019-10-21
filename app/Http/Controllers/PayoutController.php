<?php

namespace App\Http\Controllers;

use App\Payout;
use Illuminate\Http\Request;
use \App\Http\Controllers\ClassController as ClassCtrl;
use \App\Http\Controllers\LearnController as LearnCtrl;

class PayoutController extends Controller
{
    public static function mine($myId) {
        return Payout::where('user_id', $myId)->with('kelas')->get();
    }
    public function claim($classId) {
        $availableToPayout  = LearnCtrl::getAvailableToPayout($classId, ['id','class_id','to_pay']);
        $classData = ClassCtrl::info($availableToPayout[0]->class_id, 'users');
        $nominal = $availableToPayout->sum('to_pay');

        $po = Payout::create([
            'user_id' => $classData->users->id,
            'class_id' => $classId,
            'nominal' => $nominal,
            'status' => 0,
        ]);

        foreach($availableToPayout as $item) {
            $updateLearnStatus = LearnCtrl::update($item->id, ['is_payout' => 1]);
        }

        return redirect()->route('pengajar.earning');
    }
}
