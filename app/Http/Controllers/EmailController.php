<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\CompleteRegistration;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function completeRegistration() {
        $props = [
            'email' => 'riyan.satria.619@gmail.com',
            'name' => 'Riyan Satria',
            'link' => 'haha'
        ];
        Mail::to($props['email'])->send(new CompleteRegistration($props));

        return "email was sent";
    }
    public function newParticipant() {
        // 
    }
}
