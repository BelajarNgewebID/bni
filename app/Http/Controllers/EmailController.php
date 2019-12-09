<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\CompleteRegistration;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function completeRegistration($props) {
        $propsToPass = [
            'email' => $props['email'],
            'name' => $props['name'],
            'link' => route('user.activate', base64_encode($props['email']))
        ];
        Mail::to($propsToPass['email'])->send(new CompleteRegistration($propsToPass));

        return "email was sent";
    }
    public function newParticipant() {
        // 
    }
}
