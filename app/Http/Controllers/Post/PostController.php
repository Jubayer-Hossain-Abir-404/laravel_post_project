<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index()
    {
        // eloquent method 
        // this will give all the posts
        // where and find method can be used
        // this is a laravel collection
        // $posts = Post::get();
        // $posts = Post::paginate(10);
        // doing eager loading
        // $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(20);
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        // dd('ok');
        // this is validation
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Post::create([
        //     this can be written in this way too
        //     'user_id' => auth()->user()->id
        //     'user_id' => auth()->id(),
        //     'body' => $request->body
        // ]);

        // auth()->user()->posts()->create();

        // $request->user()->posts()->create([
        //      'body' => $request->body
        // ]); 
        // alternate for creating a post
        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    // this is known as root model binding
    public function destroy(Post $post)
    {
        // dd($post);

        // if(!$post->ownedBy(auth()->user())){
        //     dd('no');
        // }
        // with this an unauthorized user can't 
        // delete a post
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }
}
