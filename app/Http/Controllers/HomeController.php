<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function master(){
        $categories = Category::all();
        return view('frontend.home',compact('categories'));
    }


}
