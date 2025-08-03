<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $user=Auth::user();
            $query=Post::latest();
            if($user){
                $ids= $user->following()->pluck('users.id') ;
                $query->whereIn('user_id',$ids);
            }
            $categories=Category::all();
        $posts=$query->simplePaginate(5);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        return view ('post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
    $data = $request->validated();
        $image = $data['image'];
        // unset($data['image']);
        $imagePath= $image->store('posts','public');
        $data['image']=$imagePath;

        $data['user_id']=Auth::id();
        $data['slug']=str::slug($data['title']);

        Post::create($data);
        return redirect()->route('dashboard');                                           
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', compact('post', 'username'));    }

    /* *
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function category(Category $category){
        $posts=$category->posts()->simplePaginate(5);

        return view('post.index',compact('posts'));
    }
}
