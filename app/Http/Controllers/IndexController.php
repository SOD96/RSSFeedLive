<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Everything involving the main page
    public function showIndex()
    {
        // Get any articles by the date as to when they were published
        $articles = Article::where('deleted', false)->orderBy('published_date', 'desc')->get();

        return view('welcome', ['articles' => $articles]);
    }
}
