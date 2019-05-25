<?php

namespace App\Http\Controllers;

use App\user;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePost;

class AdminController extends Controller
{
    //
    public function __construct(){
      $this->middleware('CheckRole:admin');
    }
    public function dashboard(){
      return view('admin.dashboard');
    }
    public function posts(){
      $posts = Post::all();
      return view('admin.posts', compact('posts'));
    }
    public function postEdit($id){
      $post = Post::where('id', $id)->first();
      return view('admin.editPost', compact('post'));
    }
    public function deletePost($id){
      $post = Post::where('id', $id)->first();
      $post->delete();

      return back()->with('success', "Post Delete Successfully");
    }
    public function postEditPost(CreatePost $request, $id){
      $post = Post::where('id', $id)->first();
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->save();

      return back()->with('success', "Post Update Successfully");
    }
    public function comments(){
      $comments = Comment::all();
      return view('admin.comments', compact('comments'));
    }
    public function deleteComment(){
      $comment = Comment::where('id', $id)->first();
      $comment->delete();

      return back()->with('success', "Comment Delete Successfully");
    }
    public function users(){
      $users = User::all();
      return view('admin.users', compact('users'));
    }
    public function deleteUser(){
      $user = User::where('id', $id)->first();
      $user->delete();

      return back()->with('success', "Post Delete Successfully");
    }
    public function editUser($id){
      $user = User::where('id', $id)->first();
      $user->title = $request['title'];
      $post->content = $request['content'];
      $post->save();

      return back()->with('success', "Post Update Successfully");
    }
}
