<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index($id, $token)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return back()->with('error', 'Something is Worng!');
        } else {
            $email = $user->email;
            $old_token = $user->token;

            if ($old_token == $token) {
                return view('auth.change-password', compact('id', 'token'));
            } else {
                return back()->with('error', 'Token Invalid!');
            }
        }
    }
}
