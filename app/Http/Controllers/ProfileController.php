<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function datos(){
        $idLogged = auth()->id();


        $user = User::find($idLogged);


        return view('users.profile', compact('user'));
    }
}
