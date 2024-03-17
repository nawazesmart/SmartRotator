<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\ShortLinkDetail;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index($main_link)
    {
        $short_link = ShortLink::where('main_link', $main_link)->first();

        if ($short_link != null) {

            if ($short_link->status == true) {

                $short_link->increment('click');

                $links = ShortLinkDetail::where('short_link_id', $short_link->id)->get();

                foreach ($links as $index => $item) {

                    $rand = rand(0, count($links));

                    if ($index == $rand) {
                        if ($item->status == true) {

                            $item->increment('click');

                            return redirect($item->link);
                        } else {
                            return back()->with('error', 'The link is deactive');
                        }
                    }
                }
            } else {
                return back()->with('error', 'The link is deactive');
            }
        } else {
            return back()->with('error', 'Link Not Found.');
        }
    }
}
