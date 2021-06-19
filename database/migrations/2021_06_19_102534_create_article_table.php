<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->integer('feed_id'); // Link back to the appropriate feed we're pulling from
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->string('guid');
            $table->timestamp('published_date');
            $table->boolean('deleted')->default(false); // For if we want to delete the articles
            $table->timestamps();

            $table->primary(['id', 'feed_id']);
            $table->foreign('feed_id')->references('id')->on('feed');
            $table->index('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
