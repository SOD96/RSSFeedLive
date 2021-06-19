<?php

namespace App\Http\Controllers;

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
        $feeds = Feed::all()->where('deleted', false);

        return ['success' => true, 'feeds' => $feeds];
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

        $feed = Feed::create([
            'url' => $request->input('url')
        ]);

        return ['success' => true, $feed];
    }
}
