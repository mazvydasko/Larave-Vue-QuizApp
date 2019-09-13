<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function new(Request $request) {

        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->admin = 0;
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['user'=>$user],200);
    }
}
