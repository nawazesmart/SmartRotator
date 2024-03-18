<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class ChangePassword extends Component
{
    public $id, $token, $new_password, $re_new_password;

    public function change_password()
    {
        $this->validate([
            'new_password' => 'required|same:re_new_password',
            're_new_password' => 'required',
        ]);

        $id = $this->id;
        $user = User::where('id', $id)->first();

        $old_token = $user->token;

        $token = $this->token;

        if ($old_token == $token) {
            $result = User::findOrFail($id)->update([
                'password' => Hash::make($this->new_password),
                'token' => Str::random(40),
            ]);
            if ($result) {
                return redirect()->route('login')->with('success', 'Password Change successfully.');
            } else {
                return back()->with('error', 'Server Down!');
            }
        } else {
            return back()->with('error', 'Token Invalid!');
        }
    }

    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
