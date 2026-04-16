<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    function index()
    {
        $posts = Post::withTrashed()->with('user')->paginate(10); //withTrashed() to include soft-deleted posts, with('user') to eager load the user relationship, paginate(10) to paginate results
        return view('posts.index', compact('posts'));
    }

    function show($id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
        $users = User::orderBy('id')->get();
        return view('posts.show', compact('post', 'users'));
    }


    function create()
    {
        $users = User::orderBy('id')->get();
        return view('posts.create', compact('users'));
    }
    function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated()); //validated() to get the validated data from the request from StorePostRequest   

        return redirect('/posts?created=1');
    }

    function edit($id)
    {
        $post = Post::findorFail($id);
        $users = User::orderBy('id')->get();
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

    function forceDelete($id)
    {
        Post::withTrashed()->findOrFail($id)->forceDelete();
        return redirect('/posts?force_deleted=1');
    }

    function storeComment(StoreCommentRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->comments()->create($request->validated());

        return redirect()->route('posts.show', $id)->with('comment_created', true);
    }
}
