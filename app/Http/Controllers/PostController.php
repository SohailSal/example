<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Post;
use App\Models\Comment;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        $data2;
        if(Request::only('post')){
            $data2 = Comment::where('post_id',Request::only('post'))->get();
        }
        else {
            $data2 = [];
        }
        return Inertia::render('Posts/Index', ['data' => $data, 'data2' => $data2, 'hello' => 'world']);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store()
    {
        Post::create(
            Request::validate([
            'title' => ['required', 'max:5'],
            'body' => ['required', 'max:10', 'email'],
            ])
        );
            //        Post::create($request->all());
        return Redirect::route('posts')->with('success', 'Post created.');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
            ],
        ]);
    }

    public function update(Post $post)
    {
        $post->update(
            Request::validate([
            'title' => ['required', 'max:5'],
            'body' => ['required', 'max:10', 'email'],
            ])
        );

        return Redirect::route('posts')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return Redirect::back()->with('success', 'Post deleted.');
    }

}
