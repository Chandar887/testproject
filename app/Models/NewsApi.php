<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsApi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'endpoint', 'total_results'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'news_api_id', 'id');
    }
}
