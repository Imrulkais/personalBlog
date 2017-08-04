<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Getvalues\About;
use App\Getvalues\Contact;
use App\Getvalues\Portfolio;
use App\Getvalues\Category;
use App\Getvalues\BlogPost;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SubmitController extends Controller {

    public function doLogin() {
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

// run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

// if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            ;
        } else {

            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                return Redirect::to('/');
            } else {

                // validation not successful, send back to form 
                return Redirect::to('login');
            }
        }
    }

    public function getAbout() {

        $results = DB::table('about')->get();
        return Response::json($results);
    }

    public function getContact() {

        $results = DB::table('contact')->get();
        return Response::json($results);
    }

    public function submitAbout(Request $request) {
        $result = About::find(1);

        if ($request->input('mystory') != "") {
            $result->myStory = $request->input('mystory');
        }
        if ($request->input('age') != "") {
            $result->age = $request->input('age');
        }
        if ($request->input('email') != "") {
            $result->email = $request->input('email');
        }
        $result->save();
        return Redirect::to('about');
    }

    public function submitContact(Request $request) {
        $result = Contact::find(1);

        if ($request->input('address') != "") {
            $result->address = $request->input('address');
        }
        if ($request->input('facebook') != "") {
            $result->facebook = $request->input('facebook');
        }
        if ($request->input('twitter') != "") {
            $result->twitter = $request->input('twitter');
        }
        if ($request->input('googleplus') != "") {
            $result->googlePlus = $request->input('googleplus');
        }
        if ($request->input('linkedin') != "") {
            $result->linkedIn = $request->input('linkedin');
        }
        $result->save();
        return Redirect::to('contact');
    }

    public function submitAddPortfolio(Request $request) {



//        Getting the last Id 
        $lastid = Portfolio::select('id')->orderBy('id', 'desc')->first();
        if (empty($lastid['id']))
            $lastid = 1;
        else {
            $lastid = $lastid['id'] + 1;
        }


//        end 

        $rules = [
            'filename' => 'required',
            'title' => 'required',
            'pdetails' => 'required',
            'link' => 'required',
        ];
        $messages = [
            'required' => 'This field is required',
        ];
        $validator = Validator:: make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('addportfolio')->withErrors($validator)->withInput();
        } else {
            if ($request->isMethod('post')) {
                $table = new Portfolio();

//                upload the image
                $image = $request->file('filename');
                $portfolioextension = $request->file('filename')->getClientOriginalExtension();
                $imageRealPath = $image->getRealPath();
                $img = Image::make($imageRealPath);
                $path = public_path('dist/portfolio/');
                if (!File::exists($path))
                    File::makeDirectory($path, 0777, true);
                $img->save(public_path('dist/portfolio') . '/' . $lastid . '.' . $portfolioextension);
                chmod(public_path('dist/portfolio') . '/' . $lastid . '.' . $portfolioextension, 0777);




                $table->image = '/dist/portfolio/' . $lastid . '.' . $portfolioextension;
                $table->title = $request->input('title');
                $table->link = $request->input('link');
                $table->details = $request->input('pdetails');
                $table->save();
                return Redirect::back();
            }
        }
    }

    public function getPortfolio(Request $request) {
        $results = DB::table('portfolio')->get();
        return Response::json($results);
    }

    public function getSinglePortfolio(Request $request) {
        $id = $request->input('portfolioId');
        $results = DB::table('portfolio')->find($id);
        return Response::json($results);
    }

    public function doEditPortfolio($id, Request $request) {

        $table = Portfolio::find($id);
        //        Getting the last Id 


        if ($request->isMethod('post')) {

            // upload the image
            if ($request->file('filename')) {
                $image = $request->file('filename');
                $portfolioextension = $request->file('filename')->getClientOriginalExtension();
                $imageRealPath = $image->getRealPath();
                $img = Image::make($imageRealPath);
                $path = public_path('dist/portfolio/');
                if (!File::exists($path))
                    File::makeDirectory($path, 0777, true);
                File::delete($path . '/' . $id . '.' . $portfolioextension);
                $img->save(public_path('dist/portfolio') . '/' . $id . '.' . $portfolioextension);
                chmod(public_path('dist/portfolio') . '/' . $id . '.' . $portfolioextension, 0777);

                $table->image = '/dist/portfolio/' . $id . '.' . $portfolioextension;
            }
            if ($request->input('title')) {
                $table->title = $request->input('title');
            }
            if ($request->input('link')) {
                $table->link = $request->input('link');
            }
            if ($request->input('pdetails')) {
                $table->details = $request->input('pdetails');
            }
            $table->save();
            return Redirect::to('portfolio');
        }
    }

    public function getCategory() {
        $results = Category::get();
        return Response::json($results);
    }

    public function submitPost(Request $request) {



        $rules = [
            'Ptitle' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'required' => 'This field is required',
        ];

        $validator = Validator:: make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('addpost')->withErrors($validator)->withInput();
        } else {
            if ($request->isMethod('post')) {
                $table = new BlogPost();

                $table->title = $request->input('Ptitle');
                $table->content = $request->input('content');
                
//                Get all the category id's
                $inputarray = array();
                $results = Category::get();
                foreach ($results as $result) {
                    if ($request->input($result['category']))
                        $inputarray[] = $request->input($result['category']);
                }
                
                $table->category_id = implode(",", $inputarray);
                $table->save();
                return Redirect::back();
            }
        }
    }

    public function getBlogPost() {
        $results = DB::table('blogPost')->get();
        return Response::json($results);
    }
    public function getSearchData(Request $request) {
        $value = $request->input('searchValue');
        $results = DB::table('blogPost')->where('title', 'like', '%'.$value.'%')->get();
        return Response::json($results);
    }

    public function getCategoryData(Request $request) {
        $value = $request->input('searchValue');
        $results = DB::table('blogPost')->where('category_id', 'like', '%'.$value.'%')
            ->orWhere('category_id', 'like', '%,'.$value.',%')
            ->orWhere('category_id', 'like', '%,'.$value.'%')
            ->orWhere('category_id', 'like', '%'.$value.',%')
            ->get();


        return Response::json($results);
    }

    public function getRelatedPost(Request $request) {
        $value = $request->input('searchValue');
        $results = DB::table('blogPost')->where('category_id', 'like', '%'.$value.'%')
            ->orWhere('category_id', 'like', '%,'.$value.',%')
            ->orWhere('category_id', 'like', '%,'.$value.'%')
            ->orWhere('category_id', 'like', '%'.$value.',%')
            ->inRandomOrder()
            ->limit(3)
            ->get();


        return Response::json($results);
    }

    public function getRecentPost(Request $request) {
        $results = DB::table('blogPost')->orderBy('created_at','desc')->take(3)->get();
        return Response::json($results);
    }

    public function getSinglePost(Request $request) {
        $id = $request->input('searchId');
        $results = DB::table('blogPost')->find($id);
        return Response::json($results);
    }

}
