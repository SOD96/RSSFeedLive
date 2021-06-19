<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Feed;
use App\Traits\ProcessRSSFeed;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    use ProcessRSSFeed;

    private $feedUrl = 'https://feeds.bbci.co.uk/news/rss.xml?edition=uk';

    /**
     * We'll use this function to test the functionality.
     */
    public function adminTest()
    {
        $feeds = Feed::where('active', true)->get();
        $articles = []; // Init articles incase we get none back

        foreach($feeds as $f) {
            $array = $this->processXML($f);

            dd($array);

            if($array) {
                foreach($array['channel']['item'] as $i) {
                    // Check the article doesn't already exist
                    $articleCheck = Article::where('guid', $i['guid'])->first(); // Believe GUID will be the unique value
                    if(!$articleCheck) {
                        // Create the article
                        $articles[] = Article::create([
                            'feed_id' => $f->id,
                            'title' => $i['title'],
                            'description' => $i['description'],
                            'link' => $i['link'],
                            'guid' => $i['guid'],
                            'published_date' => Carbon::parse(strtotime($i['pubDate']))
                        ]);
                    }
                }
            }
        }

        return ['success' => true, $articles];
    }
}
