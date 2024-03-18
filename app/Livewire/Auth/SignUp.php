<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class SignUp extends Component
{
    #[Rule([
        'name' => 'required',
        'email' => ['required', 'lowercase', 'email:filter', 'max:255', 'unique:users,email'],
        'password' => ['required', 'min:6'],
    ])]

    public $first_name, $name, $email, $password;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|lowercase|email:filter|unique:users,email',
            'password' => 'required|min:6',
        ]);

        //User Store
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $role = Role::find(2);
        $user->assignRole($role);

        $this->resetInput();

        if ($user) {
            return redirect()->route('sendMail', $user->id);
        } else {
            session()->flash('error', 'Something is Worng!');
        }
    }

    public function resetInput()
    {
        $this->reset(['first_name', 'name', 'email', 'password']);
    }

    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}
