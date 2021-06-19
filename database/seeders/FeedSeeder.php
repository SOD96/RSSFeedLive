<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feed')->insert([
            'url' => 'https://feeds.bbci.co.uk/news/rss.xml?edition=uk',
            'active' => true
        ]);
    }
}
