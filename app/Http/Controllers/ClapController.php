<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClapController extends Controller
{
    public function clap(Post $post)
    {
        $userId = Auth::id();
    
        $existingClap = $post->claps()->where('user_id', $userId)->first();
    
        if ($existingClap) {
            // لو عمل clap قبل كده، نحذفه
            $existingClap->delete();
            $status = 'unclapped';
        } else {
            // لو أول مرة، نضيفه
            $post->claps()->create(['user_id' => $userId]);
            $status = 'clapped';
        }
    
        return response()->json([
            'clapsCount' => $post->claps()->count(),
            'status' => $status,
        ]);
    }
    
}
