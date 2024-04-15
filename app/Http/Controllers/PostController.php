<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        $data = [
            'posts' => $posts,
        ];
        return view('posts.index', $data);
    }

    public function indexapi()
    {
        $posts = Post::all();
        $data = [
            'posts' => $posts,
        ];
        return response()->json($data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $this->validate($request,[
            'title' => 'required',
            'publish_date'=> 'required|date',
            'topic' => 'nullable',
            'content' => 'nullable'
        ]);
        ///dd($validatedData);
        $post = Post::create($validatedData);
        return redirect()->route('posts.index');
    }

    public function storeapi(Request $request)
    {
        //
        $validatedData = $this->validate($request,[
            'title' => 'required',
            'publish_date'=> 'required|date',
            'topic' => 'nullable',
            'content' => 'nullable'
        ]);
        ///dd($validatedData);
        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        $data = [
            'post' => $post
        ];
        return view ('posts.show', $data);
    }

    public function showapi(Post $post)
    {
        //
        $data = [
            'post' => $post
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $data = [
            'post' => $post
        ];
        return view ('posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $validatedData = $this->validate($request,[
            'title' => 'required',
            'publish_date'=> 'required|date',
            'topic' => 'nullable',
            'content' => 'nullable'
        ]);
        $post->update($validatedData);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('posts.index');
    }
}
