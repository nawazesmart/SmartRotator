<?php

namespace App\Livewire\Backend;

use App\Models\ShortLink;
use App\Models\ShortLinkDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateLink extends Component
{
    #[Rule([
        'link_name' => ['required'],
        'short_link' => ['required', 'unique:short_links,main_link'],
    ])]

    public $link_name, $description, $custom_url = 0, $short_link, $type = "direct";
    public $inputs = [];

    public function mount()
    {
        $this->add();

        $this->short_link = Str::random(6);
    }

    public function add()
    {
        $this->inputs[] = ['link' => '', 'percent' => 0];

        $percent = 100 / count($this->inputs);

        foreach ($this->inputs as &$input) {
            $input['percent'] = number_format($percent, 0);
        }
    }

    public function remove($index)
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs); // Re-index the array
    }

    public function store()
    {
        $this->validate(
            [
                'link_name' => 'required',
                'short_link' => 'required|unique:short_links,main_link',
                'inputs.*.link' => 'required|url',
                'inputs.*.percent' => 'required|numeric|min:0|max:100',
            ],
            [
                'inputs.*.link.url' => 'The link :position must be URL',
                'inputs.*.link' => 'The link :position field is required',
                'inputs.*.percent' => 'Percent :position error',
            ]
        );

        $main_link = $this->short_link;

        $short_link = ShortLink::create([
            'user_id' => Auth::user()->id,
            'name' => $this->link_name,
            'description' => $this->description,
            'main_link' => $main_link,
            'type' => $this->type,
        ]);

        foreach ($this->inputs as $item) {

            ShortLinkDetail::create([
                'short_link_id' => $short_link->id,
                'link' => $item['link'],
                'percent' => $item['percent'],
            ]);
        }

        $this->resetInput();

        session()->flash('success', 'URL Create Successfully');

        $this->inputs = [['link' => '', 'percent' => '']];
    }

    public function resetInput()
    {
        $this->reset(['link_name', 'description', 'short_link']);
        $this->short_link = Str::random(6);
    }

    public function render()
    {
        return view('livewire.backend.create-link');
    }
}
