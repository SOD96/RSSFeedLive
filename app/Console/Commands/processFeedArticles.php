<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Feed;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Traits\ProcessRSSFeed;

class processFeedArticles extends Command
{
    use ProcessRSSFeed;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'processFeedArticles:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will fetch all recent articles from the active feeds and add them to the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $feeds = Feed::where('active', true)->get();

        foreach($feeds as $f) {
            $array = $this->processXML($f);
            // Update feed so it shows when it was last updated
            $f->last_checked = Carbon::now();
            $f->save();

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
        return 0;
    }
}
