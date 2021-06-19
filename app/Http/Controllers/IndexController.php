<?php

namespace App\Http\Controllers;

use App\Console\Commands\processFeedArticles;
use App\Models\Article;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class IndexController extends Controller
{
    // Everything involving the main page

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Show the main welcome page
     */
    public function showIndex()
    {
        // Get some feeds to see if the system has had any data yet
        $feed = Feed::where('active', true)->first();
        if($feed) {
            Artisan::call('processFeedArticles:start');
        }
        // Get any articles by the date as to when they were published, limited to 15 for page performance
        $articles = Article::where('deleted', false)->orderBy('published_date', 'desc')->limit(15)->get();

        return view('welcome', ['articles' => $articles]);
    }
}
