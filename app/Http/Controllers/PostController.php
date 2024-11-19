<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     $posts = Post::all();
    //     return view('posts.index', compact('posts'));   // ../views/posts/index.blade.php

    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('posts.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'title' => 'required',
    //     //     'content' => 'required'
    //     // ]);

    //     Post::create($request->all());
    //     return redirect()->route('posts.index')->with('success', 'Post create successfully');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     return view('posts.edit', compact('post'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     return view('posts.edit', compact('post'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Post $post)
    // {
    //     // $request->validate([
    //     //     'title' => 'required',
    //     //     'content' => 'required'
    //     // ]);

    //     $post->update($request->all());
    //     return redirect()->route('posts.index')->with('success', 'Post update successfully');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Post $post)
    // {
    //     $post->delete();
    //     return redirect()->route('posts.index')->with('success', 'Post delete successfully');
    // }


    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'slug' => 'required|unique:posts', 
            'title' => 'required', 
            'content' => 'required', 
            'locale' => 'required'
        ]);
        $post = Post::create( );
        $post->translations()->create(['locale' => $request->locale, 'title' => $request->title, 'content' => $request->content]);
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $translation = $post->getTranslation(app()->getLocale());
        return view('posts.show', compact('post', 'translation'));
    }

    public function edit(Post $post)
    {
        $translation = $post->getTranslation(app()->getLocale());
        return view('posts.edit', compact('post', 'translation'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required', 
                'content' => 'required', 
                'locale' => 'required'
            ]
        );
        $translation = $post->getTranslation($request->locale);
        if ($translation) {
            $translation->update(['title' => $request->title, 'content' => $request->content]);
        } else {
            $post->translations()->create(['locale' => $request->locale, 'title' => $request->title, 'content' => $request->content]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
