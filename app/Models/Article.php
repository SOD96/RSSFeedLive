<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feed_id', 'title', 'description', 'link', 'guid', 'published_date', 'deleted'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Articles belong to feeds via feed_id
     */
    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
