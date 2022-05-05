<?php

namespace App\Http\Controllers\PostLike;

use App\Http\Controllers\Controller;
use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    // with this method I was sending the ID
    // and searching the value based on id
    // public function store($id)
    // {
    //     dd('store');
    //     dd($id);
    // }

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        // dd($post);

        // dd($post->likedBy($request->user()));

        // dd($post->likes()->withTrashed()->get());

        if($post->likedBy($request->user())){
            return response(null, 409);  //conflict
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()){
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        // $user = auth()->user();
        // this is indicating the user of the post
        

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        // dd($post);
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }

}
