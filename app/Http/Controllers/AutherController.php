<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePost;

class AutherController extends Controller
{
    //
    public function __construct(){
      $this->middleware('CheckRole:auther');
    }

    public function dashboard(){
      $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
      $allComments = Comment::whereIn('post_id', $posts)->get();
      $todayComments = $allComments->where('created_at', '>=', \Carbon\Carbon::today())->count();
      //dump($posts); die;
      return view('auther.dashboard', compact('allComments', 'todayComments'));
    }
    public function posts(){
      return view('auther.posts');
    }
    public function comments(){
      return view('auther.comments');
    }
    public function newPost(){
      return view('auther.newPost');
    }
    public function createPost(CreatePost $request){
      $post = new Post();
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->user_id = Auth::id();
      $post->save();

      return back()->with('sucess', 'Post is Sucessfully Create.');
    }
}
