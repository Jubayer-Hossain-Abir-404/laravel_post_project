<?php

namespace App\Http\Controllers\UserPost;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        // dd($user);
        // $posts = $user->posts()->with(['user', 'likes'])->paginate(20);
        $posts = $user->posts()->latest()->with(['user', 'likes'])->paginate(20);
        // $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
        return view('users.posts.index',[
            'user'=> $user,
            'posts' => $posts
        ]);
    }
}
