<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'deleted', 'last_checked'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * One feed can have also one article
     */
    public function article()
    {
        return $this->hasOne(Article::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * One feed can have many articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
