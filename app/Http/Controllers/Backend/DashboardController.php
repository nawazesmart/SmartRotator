<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use App\Models\ShortLinkDetail;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view dashboard'])->only('index');
    }

    public function index()
    {
        $now = date('Y-m-d');
        $data['customers'] = User::count();
        $data['links'] = ShortLinkDetail::count();
        $data['short_links'] = ShortLink::count();
        $data['today_links'] = ShortLink::where('created_at', 'like', "%$now%")->count();
        $data['users'] = User::latest()->take(10)->get();

        return view('backend.index', $data);
    }
}
