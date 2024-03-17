<?php

namespace App\Livewire\Backend;

use App\Models\ShortLink;
use App\Models\ShortLinkDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditLink extends Component
{
    #[Rule([
        'link_name' => ['required'],
        'short_link' => ['required'],
    ])]

    public $id, $link_name, $description, $custom_url = 1, $short_link;
    public $inputs = [];

    public function mount()
    {
        $short_link = ShortLink::find($this->id);

        if ($short_link != null) {
            $this->link_name = $short_link->name;
            $this->description = $short_link->description;
            $this->short_link = $short_link->main_link;

            $link_details = ShortLinkDetail::where('short_link_id', $short_link->id)->get();

            if ($link_details != null) {
                foreach ($link_details as $item) {
                    array_push($this->inputs, ['id' => $item->id, 'link' => $item->link, 'percent' => $item->percent]);
                }
            }
        }

        $this->add();
    }

    public function add()
    {
        $this->inputs[] = ['id' => '', 'link' => '', 'percent' => 0];

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

    public function deleteLink($id, $index)
    {
        $link = ShortLinkDetail::find($id);

        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs); // Re-index the array


        $link->delete();
    }

    public function update()
    {

        $this->validate(
            [
                'link_name' => 'required',
                'short_link' => 'required|unique:short_links,main_link,' . $this->id,
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

        $short_link_id = ShortLink::find($this->id)->update([
            'user_id' => Auth::user()->id,
            'name' => $this->link_name,
            'description' => $this->description,
            'main_link' => $main_link,
        ]);

        foreach ($this->inputs as $item) {
            ShortLinkDetail::updateOrCreate(['id' => $item['id'] ?? null], [
                'short_link_id' => $this->id,
                'link' => $item['link'],
                'percent' => $item['percent'],
            ]);
        }

        session()->flash('success', 'URL Update Successfully');
    }

    public function resetInput()
    {
        $this->reset(['link_name', 'description', 'short_link']);
    }

    public function render()
    {
        return view('livewire.backend.edit-link');
    }
}
