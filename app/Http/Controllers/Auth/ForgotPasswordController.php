<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function sendMail($id)
    {
        $token = Str::random(40);
        $otp = rand(1000, 9999);

        $user = User::findOrFail($id)->update([
            'otp' => $otp,
            'expire_otp' => time(),
            'token' => $token,
        ]);

        $user = User::findOrFail($id);
        $email = $user->email;
        $name = $user->name;
        $title = 'Reset Password';
        return redirect()->route('forgotPasswordVerification', ['id' => $id, 'token' => $token])->with('success', 'Email send successfully.');
        // $result = Mail::to($email)->send(new EmailVerifyMail($email, $title, $name, $otp));
        // if($result){
        //     return redirect()->route('forgotPasswordVerification', ['id' => $id, 'token' => $token])->with('success','Email send successfully.');
        // }else{
        //     return back()->with('error','Something is Worng!');
        // }
    }


    public function varification($id, $token)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return back()->with('error', 'User not found !');
        } else {
            $email = $user->email;
            $old_token = $user->token;

            if ($old_token == $token) {
                return view('auth.forgot-verification', compact('email', 'id'));
            } else {
                return back()->with('error', 'Token Invalid!');
            }
        }
    }
}
