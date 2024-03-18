<?php

namespace App\Livewire\Backend;

use App\Models\ShortLink;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserLink extends Component
{
    use WithPagination;

    public $id, $search, $size = "10", $status;

    public function copyLink($link)
    {
        $this->dispatch('copyText', $link);
    }

    public function delete($id)
    {
        ShortLink::find($id)->delete();

        session()->flash('succes', 'Link Delete Successfully');
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
        $query = ShortLink::latest()->where('user_id', Auth::user()->id);

        $data = [];

        if ($this->status == null) {
            $data['short_links'] = $query
                ->where('name', 'like', "%{$this->search}%")
                ->paginate($this->size);
        } else {
            $data['short_links'] = $query
                ->where('name', 'like', "%{$this->search}%")
                ->where('status', '=', "$this->status")
                ->paginate($this->size);
        }

        $data['total_short_links'] = ShortLink::count();
        return view('livewire.backend.user-link', $data);
    }
}
