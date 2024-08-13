<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('partials.welcome');
    }

    public function contact()
    {
        return view('partials.contact');
    }
    
    public function about()
    {
        return view('partials.about');
    }

    public function blog()
    {
        $news = News::with('user')->get();
        return view('partials.blog', compact('news'));
    }
    

    public function detail_blog()
    {
        return view('partials.detail_blog');
    }
}
