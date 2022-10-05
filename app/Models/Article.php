<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'news_api_id', 'source_id', 'source_name', 'author', 'title', 'description', 'url', 'urlToImage', 'publishedAt', 'content'
    ];

    public function newsApi()
    {
        return $this->belongsTo(NewsApi::class, 'id', 'news_api_id');
    }
}
