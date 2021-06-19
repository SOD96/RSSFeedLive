<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed', function (Blueprint $table) {
            $table->id();
            $table->string('url'); // Our feed url
            $table->boolean('active')->default(true); // whether the feed is active or not
            $table->timestamp('last_checked')->nullable(); // Update this timestamp whenever we pull the latest articles
            $table->timestamps();

            $table->index('active'); // Indexing active as we'll only be getting the active feeds
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feed');
    }
}
