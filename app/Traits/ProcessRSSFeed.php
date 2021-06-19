<?php

namespace App\Traits;

trait ProcessRSSFeed
{

    /**
     * @param $f
     * @return mixed
     * Take all the XML converting to JSON, converting back out of the main functions and into a trait to keep it clean
     */
    protected function processXML($f)
    {
        $feed = implode(file($f->url)); // Fetch XML rss feed

        // Load XML String
        $xml = simplexml_load_string($feed,'SimpleXMLElement', LIBXML_NOCDATA);
        // Encode into JSON
        $json = json_encode($xml);
        // Decode into a PHP Array
        return json_decode($json,TRUE);
    }
}
