<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function inbox(){

          $posts = Post::all();
          return view('welcome', compact('posts'));
    }
    public function singlePost(Post $post){
        //  $post = Post::find($id);
          return view('singlePost', compact('post'));
    }
    public function about(){
          return view('about');
    }
    public function contact(){
          return view('contact');
    }
    public function contactPost(){
          return view('contactPost');
    }
}
