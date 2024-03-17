<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Verification extends Component
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
        $id = $user->id;
        $time = $user->expire_otp;
        $currentTime = time();

        if ($oldOTP == $otp) {
            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
                $users = User::find($id);
                $users->is_verified = 1;
                $result = $users->save();
                if ($result) {
                    Auth::logout();
                    return redirect()->route('login')->with('success', 'Email verify successfully.');

                    $this->resetInput();
                } else {
                    session()->flash('error', 'Something is Worng !');
                }
            } else {
                session()->flash('error', 'Your OTP has been Expired!');
            }
        } else {
            session()->flash('error', 'Please enter valid OTP !');
        }
    }

    public function resetInput()
    {
        $this->reset(['email', 'otp']);
    }

    public function render()
    {
        return view('livewire.auth.verification');
    }
}
