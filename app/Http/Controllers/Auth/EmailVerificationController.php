<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerifyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function index($id, $token)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return redirect()->route('signUp')->with('error', 'Something is Worng!');
        } else {
            $email = $user->email;
            $old_token = $user->token;

            if ($old_token == $token) {
                return view('auth.verification', compact('email', 'id'));
            } else {
                return back()->with('error', 'Token Invalid!');
            }
        }
    }

    public function sendMail($id)
    {
        $token = Str::random(40);
        $otp = rand(1000, 9999);

        $user = User::find($id);
        $user->otp = $otp;
        $user->expire_otp = time();
        $user->token = $token;
        $user->save();

        $name = $user->name;
        $email = $user->email;
        $title = 'Email Verification';
        return redirect("/verification/" . $id . '/' . $token)->with('success', 'Email send successfully.');
        // $result = Mail::to($email)->send(new EmailVerifyMail($email, $title, $name, $otp));
        // if ($result) {
        //     return redirect("/verification/" . $id . '/' . $token)->with('success', 'Email send successfully.');
        // } else {
        //     return back()->with('error', 'Something is Worng!');
        // }
    }
}
