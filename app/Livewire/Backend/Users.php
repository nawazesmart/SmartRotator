<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

    #[Rule([
        'name' => ['required'],
        'email' => ['required', 'email:filter'],
        'status' => ['required'],
        'role' => ['required'],
    ])]

    public $id, $search, $size = "10", $role_id, $name, $email, $status = "1", $password, $role;

    public function edit($id)
    {
        $user = User::find($id);

        if ($user) {
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->status = $user->status;
            $this->role = $user->role_id;
        } else {
            return redirect()->route('users.index');
        }
    }

    //User Update
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email,' . $this->id,
            'status' => 'required',
            'role' => 'required',
            'password' => 'nullable|min:6',
        ]);

        if (!empty($this->password)) {
            User::find($this->id)->update([
                'password' => Hash::make($this->password),
            ]);
        }

        $user = User::find($this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
            'status' => $this->status,
        ]);

        $user = User::where('id', $this->id)->first();

        $role = Role::find($this->role);

        $user->syncRoles($role);

        $this->dispatch('close-modal');

        if ($user) {
            session()->flash('success', 'User Update Successfully.');
        } else {
            session()->flash('error', 'Something is worng!');
        }
    }

    //User Store
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email',
            'status' => 'required',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
            'status' => $this->status,
            'is_verified' => '1',
            'password' => Hash::make($this->password),
        ]);

        $role = Role::find($this->role);

        $user->syncRoles($role);

        $this->resetInput();

        if ($user) {
            session()->flash('success', 'Account Create Successfully.');
        } else {
            session()->flash('error', 'Something is worng!');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();

        session()->flash('success', 'User Delete Successfully');
    }

    public function closeModal()
    {
        $this->resetInput();
    }
    public function resetInput()
    {
        $this->reset(['id', 'search', 'size', 'name', 'email', 'status', 'password', 'role']);
    }
    public function render()
    {
        $query = User::with('roles')->latest();

        $data = [];

        if ($this->role_id == null) {
            $data['users'] = $query
                ->where('email', 'like', "%{$this->search}%")
                ->paginate($this->size);
        } else {
            $data['users'] = $query
                ->where('email', 'like', "%{$this->search}%")
                ->where('role_id', '=', "$this->role_id")
                ->paginate($this->size);
        }

        $data['total_user'] = User::count();
        $data['roles'] = Role::all();
        return view('livewire.backend.users', $data);
    }
}
