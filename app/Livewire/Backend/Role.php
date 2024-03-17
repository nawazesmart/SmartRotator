<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends Component
{
    use WithPagination;

    public $id, $search, $size = "10";

    public function delete($id)
    {
        ModelsRole::find($id)->delete();

        session()->flash('succes', 'Role Delete Successfully');
    }

    public function closeModel()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset(['id', 'search']);
    }

    public function render()
    {
        $data['roles'] = ModelsRole::with('permissions')
            ->latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate($this->size);

        $data['total_role'] = ModelsRole::count();
        return view('livewire.backend.role', $data);
    }
}
