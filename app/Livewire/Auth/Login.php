<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule([
        'email' => ['required', 'lowercase', 'email:filter', 'max:255'],
        'password' => ['required'],
    ])]

    public $email, $password, $remember = 1;

    public function login()
    {
        $user = $this->validate([
            'email' => 'required|lowercase|email:filter|max:255',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($user, $this->remember)) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Please enter valid details!');
        }
    }
}
