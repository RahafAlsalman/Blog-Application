<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;


class DashboardController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
      

     
    }
    
    
    
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])->latest()->get();
       
         return view('dashboard',['posts' =>  $posts]);
    }

    
}
