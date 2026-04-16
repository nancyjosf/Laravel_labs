<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image_path'] = $path;
        }

        Post::create([
            'title'    => $data['title'],
            'content'  => $data['content'],
            'user_id'  => Auth::id(),
            'image_path' => $data['image_path'] ?? null,
        ]);

        return redirect('/posts?created=1');
    }
    function edit($id)
    {
        $post = Post::findOrFail($id);
        
        // Authorization: only owner can edit
        if (!$post->isOwnedBy(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }
        
        $users = User::orderBy('id')->get();
        return view('posts.edit', compact('post', 'users'));
    }

    function update($id, UpdatePostRequest $request)
    {
        $post = Post::findOrFail($id);
        
        // Authorization: only owner can update
        if (!$post->isOwnedBy(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }
        
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $path = $request->file('image')->store('posts', 'public');
            $data['image_path'] = $path;
        }

        $post->update($data);
        return redirect('/posts?updated=1');
    }

    function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Authorization: only owner can delete
        if (!$post->isOwnedBy(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        return redirect('/posts?deleted=1');
    }

    function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        
        // Authorization: only owner can restore
        if (!$post->isOwnedBy(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }
        
        $post->restore();
        return redirect('/posts?restored=1');
    }

    function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        
        // Authorization: only owner can permanently delete
        if (!$post->isOwnedBy(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete image before permanently deleting post
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        
        $post->forceDelete();
        return redirect('/posts?force_deleted=1');
    }

    function storeComment(StoreCommentRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->comments()->create($request->validated());

        return redirect()->route('posts.show', $id)->with('comment_created', true);
    }
}
