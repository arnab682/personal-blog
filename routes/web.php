<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PublicController@inbox')->name('index');
Route::get('post/{post}', 'PublicController@singlePost')->name('singlePost');
Route::get('about', 'PublicController@about')->name('about');
Route::get('contact', 'PublicController@contact')->name('contact');
Route::get('contactPost', 'PublicController@contactPost')->name('contactPost');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix('user')->group(function(){
  Route::get('dashboard', 'UserController@dashboard')->name('userDashboard');
  Route::get('comments', 'UserController@comments')->name('userComments');
    Route::post('comments/{id}/delete', 'UserController@deleteComment')->name('deleteComment');
  Route::get('profile', 'UserController@profile')->name('userProfile');
  Route::post('profile', 'UserController@profilePost')->name('userProfilePost');
});

Route::prefix('auther')->group(function(){
  Route::get('dashboard', 'AutherController@dashboard')->name('autherDashboard');
  Route::get('posts', 'AutherController@posts')->name('autherPosts');
  Route::get('posts/new', 'AutherController@newPost')->name('newPost');
  Route::post('posts/new', 'AutherController@createPost')->name('createPost');
  Route::get('posts/{id}/edit', 'AutherController@postEdit')->name('postEdit');
  Route::post('posts/{id}/edit', 'AutherController@postEditPost')->name('postEditPost');
  Route::post('posts/{id}/delete', 'AutherController@deletePost')->name('deletePost');
  Route::get('comments', 'AutherController@comments')->name('autherComments');
});

Route::prefix('admin')->group(function(){
  Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');
  Route::get('posts', 'AdminController@posts')->name('adminPosts');
  Route::get('posts/{id}/edit', 'AdminController@postEdit')->name('postEdit');
  Route::post('posts/{id}/edit', 'AdminController@postEditPost')->name('postEditPost');
  Route::post('posts/{id}/delete', 'AdminController@deletePost')->name('deletePost');
  Route::get('comments', 'AdminController@comments')->name('adminComments');
  Route::post('comments/{id}/delete', 'AdminController@deleteComments')->name('adminDeleteComments');
  Route::get('users', 'AdminController@users')->name('adminUsers');
  Route::post('users/{id}/delete', 'AdminController@deleteUser')->name('deleteUser');
  Route::post('users/{id}/edit', 'AdminController@editUser')->name('editUser');
});
