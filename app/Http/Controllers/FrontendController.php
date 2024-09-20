<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
     function dashboard(){
        return view('dashboard');
     }

     function author_login(){
        return view('frontend.author.author_login');
     }
   function author_register(){
     return view('frontend.author.author_register');
   }
}
