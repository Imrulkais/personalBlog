<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests;

class ViewController extends Controller {

    public function index() {
        return View::make('index');
    }
    
    public function about(){
        return View::make('about');
    }
    public function portfolio(){
        return View::make('portfolio');
    }
    public function blog(){
        return View::make('blog');
    }
    public function contact(){
        return View::make('contact');
    }
    public function login(){
        return View::make('login');
    }
    public function editAbout(){
        return View::make('editAdd/editabout');
    }
    public function editContact(){
        return View::make('editAdd/editcontact');
    }
    public function addPortfolio(){
        return View::make('editAdd/addportfolio');
    }
    public function editSinglePortfolio($id){
        return View::make('editAdd/editportfolio')->with('id',$id);
    }
    public function addPost(){
        return View::make('editAdd/addpost');
    }
}
