<?php

namespace App\Http\Controllers;

use App\Learn;
use Illuminate\Http\Request;
use \App\Http\Controllers\UserController as UserCtrl;

class InvoiceController extends Controller
{
    public static function isPaid($userId, $classId) {
        $get = Learn::where([
            ['user_id', $userId],
            ['class_id', $classId],
        ])->first();
        return $get->status;
    }
    public function mine() {
        $myData = UserCtrl::me();
        $myId = $myData->id;

        $data = Learn::where([
            ['user_id', $myId],
            ['status', 0],
            ['to_pay', '>', 0]
        ])->with('material')->get();

        // return dd($data);

        return view('user.invoice')->with([
            'inv' => $data,
            'myData' => $myData,
        ]);
    }
    public function validateImage($name) {
        $a = explode(".", $name);
        return $a[count($a) - 1];
    }
    public function pay($learnId, Request $req) {
        $validateData = $this->validate($req, [
            'evidence' => 'required|image'
        ]);

        $evidence = $req->file('evidence');
        $fileName = $evidence->getClientOriginalName();
        $evidence->storeAs('public/evidences/', $fileName);

        $inv = Learn::where('id', $learnId)->first();
        $inv->status = 2;
        $inv->evidence = $fileName;
        $inv->save();

        return redirect()->route('invoice.done');
    }
    public function payPage($id) {
        $myData = UserCtrl::me();
        $invoice = Learn::where('id', $id)->with('kelas')->first();

        return view('user.pay')->with([
            'myData' => $myData,
            'invoice' => $invoice,
        ]);
    }
    public function done() {
        $myData = UserCtrl::me();
        return view('user.donePay')->with(['myData' => $myData]);
    }
    public function accept($id) {
        $inv = Learn::find($id)->update([['status', 1]]);
        return redirect()->route('admin.invoice');
    }
    public function decline($id) {
        $inv = Learn::find($id);
        $inv->status = 0;
        $inv->evidence = '';

        $deleteFile = Storage::delete('public/videos/'.$inv->evidence);

        $inv->save();

        return redirect()->route('admin.invoice');
    }
}
