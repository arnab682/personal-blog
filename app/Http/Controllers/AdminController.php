<?php

namespace App\Http\Controllers;

use App\user;
use App\Post;
use App\Comment;
use App\Product;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserUpdate;
use App\Http\Requests\NewProductPost;

class AdminController extends Controller
{
    //
    public function __construct(){
      $this->middleware('CheckRole:admin');
      $this->middleware('auth');
    }

    public function dashboard(){
      /*$chart = new DashboardChart;
      $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
      $comments = [];
      foreach($days as $day){
      $comments[] = Comment::whereData('created_at', $day)->where('user_id', Auth::id())->count();
      }
      $chart->dataset('Comments', 'line', $comments);
      $chart->labels($days);*/

      //return view('admin.dashboard', compact('chart'));
      return view('admin.dashboard');
    }

    /*private function generateDateRange(Carbon $start_date, Carbon $end_date){

      $dates = [];
      for($date = $start_date; $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d');
      }
      return $dates;
    }*/


    public function posts(){
      $posts = Post::all();
      return view('admin.posts', compact('posts'));
    }
    public function postEdit($id){
      $post = Post::where('id', $id)->first();
      return view('admin.editPost', compact('post'));
    }
    public function postEditPost(CreatePost $request, $id){
      $post = Post::where('id', $id)->first();
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->save();

      return back()->with('success', "Post Update Successfully");
    }
    public function deletePost($id){
      $post = Post::where('id', $id)->first();
      $post->delete();

      return back()->with('success', "Post Delete Successfully");
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
    public function editUser($id){
      $user = User::where('id', $id)->first();
      return view('admin.editUser', compact('user'));
    }
    public function editUserPost(UserUpdate $request, $id){
      $user = User::where('id', $id)->first();
      $user->name = $request['name'];
      $user->email = $request['email'];

      if ($request['author'] == 1) {
        $user->author == true;
      } elseif ($request['admin'] == 1) {
        $user->amdin == true;
      }

      $user->save();
      dump($user);die();
      return back()->with('success', "User Update Successfully");
    }
    public function deleteUser($id){
      $user = User::where('id', $id)->first();
      $user->delete();

      return back()->with('success', "Post Delete Successfully");
    }
    public function products(){
      $products = Product::all();
      return view('admin.products', compact('products'));
    }
    public function newProduct(){

      return view('admin.newProduct');
    }
    public function newProductPost(NewProductPost $request){
      /* $this->validate($request,[
        'title' => 'required|string',
        'thumbnail' => 'required|file',
        'description' => 'required',
        'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9])?$/'
      ]); */

      $product = new Product;
      $product->title = $request['title'];
      $product->description = $request['description'];
      $product->price = $request['price'];

      $thumbnail = $request->file('thumbnail');

      $fileName = $thumbnail->getClientOriginalName();
      $fileExtension = $thumbnail->getClientOriginalExtension();

      $thumbnail->move('product-images', $fileName);
      $product->thumbnail = 'product-images/'.$fileName;

      //dump('$product[]'); die();
      $product->save();

      //return back();
      return back()->with('success', "User Update Successfully");
    }
    public function editProduct(){

    }
    public function editProductPost(Request $request){

    }
}
