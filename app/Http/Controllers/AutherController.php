<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutherController extends Controller
{
    //
    public function __construct(){
      $this->middleware('CheckRole:auther');
    }

    public function dashboard(){
        return view('auther.dashboard');
    }
    public function posts(){
        return view('auther.posts');
    }
    public function comments(){
        return view('auther.comments');
    }
}
