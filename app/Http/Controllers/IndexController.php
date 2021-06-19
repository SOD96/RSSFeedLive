<?php

namespace App\Http\Controllers;

use App\Console\Commands\processFeedArticles;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class IndexController extends Controller
{
    // Everything involving the main page
    public function showIndex()
    {
        Artisan::call('processFeedArticles:start');
        // Get any articles by the date as to when they were published
        $articles = Article::where('deleted', false)->orderBy('published_date', 'desc')->get();

        return view('welcome', ['articles' => $articles]);
    }
}
