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
      $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
      $comments = Comment::whereIn('post_id', $posts)->get();
      return view('auther.comments', compact('comments'));
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

      return back()->with('success', 'Post is Sucessfully Create.');
    }
    public function postEdit($id){
      $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
      return view('auther.editPost', compact('post'));
    }
    public function postEditPost(CreatePost $request, $id){
      $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->save();

      return back()->with('success', "Post Update Successfully");
    }
    public function deletePost($id){
      $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
      $post->delete();

      return back()->with('success', "Post Delete Successfully");
    }
}
