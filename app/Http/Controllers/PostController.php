<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store','destroyi');
    }

    public function index()
    {
        $posts = Post::latest()->with(['user','likes'])->paginate(20);
//        dd($posts);
        return view('posts.index',compact('posts'));
   }

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
   }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'body' => 'required'
        ]);

        $request->user()->posts()->create([
           'body' => $request->body,
        ]);


        return back();
    }

    public function destroy(Post $post){

        if(!$post->ownedBy(auth()->user())){
            dd('no');
        }
            $post->delete();
        return back();
    }


}
