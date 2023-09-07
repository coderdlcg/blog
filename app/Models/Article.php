<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'seo_title',
        'seo_description',
        'slug',
        'body',
        'status',
        'author_id',
        'rating',
        'thumbnail',
        'published_at',
        'deleted_at',
    ];
}
