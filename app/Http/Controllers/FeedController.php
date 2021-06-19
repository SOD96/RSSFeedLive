<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    //

    private $feedUrl = 'https://feeds.bbci.co.uk/news/rss.xml?edition=uk';

    /**
     * We'll use this function to create the feeds that we'll be subscribing too.
     */
    public function createFeed()
    {
        $articles = []; // Init articles incase we get none back
        $n = 0;
        $feed = implode(file($this->feedUrl)); // Fetch XML rss feed

        $xml = simplexml_load_string($feed,'SimpleXMLElement', LIBXML_NOCDATA); // Load string using simple XML
        $json = json_encode($xml); // Encode XML into useable JSON
        $array = json_decode($json,TRUE); // Decode the JSON into a PHP Array

        if($array) {
            foreach($array['channel']['item'] as $i) {
                if($n == 6)
                {
                    break;
                }
                $articles[] = $i;
                $n++;

            }
        }
        if($articles) {

        }

        return $articles;
    }
}
