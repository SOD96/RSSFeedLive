<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Feed;

class APIController extends Controller
{
    /**
     * @return array
     * Returns any feeds that are currently not deleted in our system
     */
    public function getFeed()
    {
        $feed = Feed::where('active', true)->get();

        return ['success' => true, 'feed' => $feed];
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Post a feed URL into the API
     */
    public function postFeed(Request $request) {
        // Validate input
        $request->validate([
            'url' => 'required|max:255'
        ]);

        // Check if the feed already exists
        $feed = Feed::where('url', $request->input('url'))->first();

        if(!$feed) {
            $feed = Feed::create([
                'url' => $request->input('url')
            ]);
        }

        // We'll always return with a successful feed result, even if the feed exists because we still want them to
        // believe it's been added to the system, foils spam attempts etc...
        return ['success' => true, $feed];
    }

    /**
     * @return array
     * Get all articles that aren't deleted
     */
    public function getArticles()
    {
        $article = Article::where('deleted', false)->get();

        return ['success' => true, 'article' => $article];
    }
}
