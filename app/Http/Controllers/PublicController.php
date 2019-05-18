<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function inbox(){
          return view('welcome');
    }
    public function singlePost($id){
          return view('singlePost');
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
