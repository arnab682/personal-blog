<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Comment;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    /*public function __construct(){
      $this->middleware('CheckRole:user');
    }*/

    public function __construct(){
      $this->middleware('auth');
    }

    public function dashboard(){
      $chart = new DashboardChart;

      $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());

      $comments = [];

      foreach($days as $day){
        $comments[] = Comment::whereData('created_at', $day)->where('user_id', Auth::id())->count();
      }
      $chart->dataset('Comments', 'line', $comments);
      $chart->labels($days);

      return view('user.dashboard', compact('chart'));
    }
    private function generateDateRange(Carbon $start_date, Carbon $end_date){
      $dates = [];

      for($date = $start_date; $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d');
      }
      return $dates;
    }
    public function comments(){
      return view('user.comments');
    }
    public function deleteComment($id){
      $comment = Comment::where('id', $id)->where('user_id', Auth::id())->delete();
      return back();
    }
    public function profile(){
      return view('user.profile');
    }
    public function profilePost(UserUpdate $request){
      //dump($request->all());
      $user = Auth::user();
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->save();

      if($request['password'] != ""){
        if(!(Hash::check($request['password'], Auth::user()->password))){
          return redirect()->back()->with('error', "Your current password does not match with the password you provided");
        }
        if(strcmp($request['password'], $request['new_password']) == 0){
          return redirect()->back()->with('error', "New Password cannot be same as your New Confirmation Password.");
        }
        $validation = $request->validate([
          'password' => 'required',
          'new_password' => 'required|string|min:6|confirmed',
        ]);
        $user->password = bcrypt($request['new_password']);
        $user->save();

        return redirect()->back()->with('success', "Password changed successfully");
      }

      return back();
    }
}
