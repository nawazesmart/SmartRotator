<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use App\Models\ShortLinkDetail;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function index()
    {
        return view('backend.short-link.index');
    }

    public function create()
    {
        return view('backend.short-link.create');
    }

    public function view($id)
    {
        $link = ShortLink::find($id);

        if (!empty($link)) {
            $data['link'] = $link;

            $data['links_details'] = ShortLinkDetail::where('short_link_id', $id)->get();

            $data['total_click'] = ShortLinkDetail::where('short_link_id', $id)->sum('click');

            return view('backend.short-link.show', $data);
        }
    }

    public function edit($id)
    {
        $link = ShortLink::find($id);

        if (!empty($link)) {
            $data['id'] = $link->id;

            return view('backend.short-link.edit', $data);
        }
    }
}
