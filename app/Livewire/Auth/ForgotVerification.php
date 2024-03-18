<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ForgotVerification extends Component
{
    #[Rule([
        'otp' => ['required', 'numeric'],
    ])]

    public $email, $otp;

    public function verify()
    {
        $this->validate([
            'email' => 'required|email:filter',
            'otp' => 'required|numeric',
        ]);

        $otp = $this->otp;

        $email = $this->email;
        $user = User::where('email', $email)->first();

        $oldOTP = $user->otp;
        $token = $user->token;
        $id = $user->id;
        $time = $user->expire_otp;
        $currentTime = time();

        if ($oldOTP == $otp) {
            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
                return redirect("/change-password/" . $id . '/' . $token)->with('success', 'Email Varify successfully.');
            } else {
                return back()->with('error', 'Your OTP has been Expired!');
            }
        } else {
            return back()->with('error', 'Please enter valid OTP !');
        }
    }

    public function resetInput()
    {
        $this->reset(['email', 'otp']);
    }

    public function render()
    {
        return view('livewire.auth.forgot-verification');
    }
}
