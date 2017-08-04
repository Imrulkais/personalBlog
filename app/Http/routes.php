<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Route::get('/', function () {
//    return view('index');
//});
//View pages
Route::get('/', 'ViewController@index');
Route::get('about', 'ViewController@about');
Route::get('portfolio', 'ViewController@portfolio');
Route::get('blog', 'ViewController@blog');
Route::get('contact', 'ViewController@contact');
Route::get('login', 'ViewController@login');

//Edit and add pages
Route::group(['middleware' => 'auth'], function() {
    Route::get('editabout', 'ViewController@editAbout');
    Route::get('editcontact', 'ViewController@editContact');
    Route::get('addportfolio', 'ViewController@addPortfolio');
    Route::get('editsingleportfolio/{id}', 'ViewController@editSinglePortfolio');
    Route::get('addpost', 'ViewController@addPost');

    //Submit updates
    Route::post('submitabout', 'SubmitController@submitAbout');
    Route::post('submitcontact', 'SubmitController@submitContact');
    Route::post('submitaddportfolio', 'SubmitController@submitAddPortfolio');
    Route::post('doeditportfolio/{id}', 'SubmitController@doEditPortfolio');
    Route::post('submitpost', 'SubmitController@submitPost');
});

//Get datas
Route::get('getabout', 'SubmitController@getAbout');
Route::get('getcontact', 'SubmitController@getContact');
Route::get('getportfolio', 'SubmitController@getPortfolio');
Route::get('getsingleportfolio', 'SubmitController@getSinglePortfolio');
Route::get('getcategory', 'SubmitController@getCategory');
Route::get('getblogpost', 'SubmitController@getBlogPost');
Route::get('getsearchdata', 'SubmitController@getSearchData');
Route::get('getcategorydata', 'SubmitController@getCategoryData');
Route::get('getrecentpost', 'SubmitController@getRecentPost');
Route::get('getsinglepost', 'SubmitController@getSinglePost');
Route::get('getrelatedpost', 'SubmitController@getRelatedPost');

//Backend works
Route::post('dologin', 'SubmitController@doLogin');
Route::get('logout', function () {
    Auth::logout();
    return Redirect::to('/');
});
