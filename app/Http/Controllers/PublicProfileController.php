<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    Public function show(User $user){
        $posts=$user->posts()->latest()->paginate();

        return view('profile.show',compact('user','posts'));
    }
}
