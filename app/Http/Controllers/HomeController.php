<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function homepage(){
      return view('home.homepage');
    }
    public function ourproducts(){
    	return view('home.ourproducts');
    }
    public function about(){
    	return view('home.about');
    }
    public function contact(){
    	return view('home.contact');
    }
    public function faq(){
    	return view('home.faq');
    }

}
?>
