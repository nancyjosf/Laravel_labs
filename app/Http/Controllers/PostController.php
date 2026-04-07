<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
   
    function index()
    {
        $posts = Post::with('user')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    function show($id)
    {
        $post = Post::findorFail($id);
        return view('posts.show', compact('post'));
    }


    function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }
    function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());    
            
        return redirect('/posts?created=1');
    }

   function edit($id)
{
    $post = Post::findorFail($id);
    $users = User::all();  
    return view('posts.edit', compact('post', 'users'));  
}

    function update($id, UpdatePostRequest $request)
    {
        $post = Post::findorFail($id);
        $post->update($request->validated());
        return redirect('/posts?updated=1');
    }
    
    function destroy($id)
    {
        Post::destroy($id);
        return redirect('/posts?deleted=1');
    }

    function restore($id)
    {
        Post::withTrashed()->findOrFail($id)->restore();
        return redirect('/posts?restored=1');
    }
    
}
