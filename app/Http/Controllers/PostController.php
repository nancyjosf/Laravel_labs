<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public $posts = [
        [
            "id" => 1,
            "title" => "My first post",
            "content" => "This is the content of my first post."
        ],
        [
            "id" => 2,
            "title" => "My second post",
            "content" => "This is the content of my second post."
        ],
        [
            "id" => 3,
            "title" => "My third post",
            "content" => "This is the content of my third post."
        ]
    ];
    function index()
    {
        $posts = $this->posts;
        return view('posts.index', compact('posts'));
    }

    // SHOW: Display a single post by ID
    function show($id)
    {
        $post = null;
        foreach ($this->posts as $p) {
            if ($p["id"] == $id) {
                $post = $p;
                break;
            }
        }
        return view('posts.show', compact('post'));
    }


    function create()
    {
        return view('posts.create');
    }
    function store()
    {
      return redirect('/posts?created=1');

    }

    function edit($id)
    {
        $post = null;
        foreach ($this->posts as $p) {
            if ($p["id"] == $id) {
                $post = $p;
                break;
            }
        }
        return view('posts.edit', compact('post'));
    }

    function update($id, Request $request)
    {
        return redirect('/posts?updated=1');
    }
    function destroy($id)
    {
        return redirect('/posts?success=1');
    }
}
