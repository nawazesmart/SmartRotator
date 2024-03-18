<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ForgotPassword extends Component
{
    #[Rule([
        'email' => ['required', 'lowercase', 'email:filter', 'max:255'],
    ])]

    public $email;

    public function forgot_password()
    {
        $this->validate([
            'email' => 'required|email:filter|exists:users,email',
        ]);

        $user = User::where('email', $this->email)->first();

        $user_id = $user->id;

        return redirect()->route('forgotPasswordSendMail', $user_id);
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
