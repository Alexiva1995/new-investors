<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function listUser()
    {
        $user = User::all();


        return view('users.list-users')
            ->with('user', $user);
    }

    public function showUser($id)
    {

        $user = user::find($id);
        $inv = Inversion::where('user_id', $user->id)->get();
        
        return view('users.show-user')
            ->with('user', $user)
            ->with('inv', $inv);
    }
}
