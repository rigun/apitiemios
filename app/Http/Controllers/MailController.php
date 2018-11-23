<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use App\User;
class MailController extends Controller
{
    public function send(Request $request)
    {
        $this->validateWith([
            'email' => 'required',
          ]);
        $user = User::where('email', $request->email)->first();

        $objDemo = new \stdClass();
        $objDemo->token = $user->token;
 
        Mail::to($user->email)->send(new VerificationMail($objDemo));

        return 'email terkirim';
    }
}
