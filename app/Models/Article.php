<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    protected const STATUSES = [
        0 => 'draft',
        1 => 'published',
        2 => 'moderation',

    ];

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

    public function getStatusDesc() : string
    {
        return __('moonshine::ui.blog.article.statuses.' . self::STATUSES[$this->status]);
    }

    static public function getAllStatusesDesc() : array
    {
        $statuses = [];
        foreach (self::STATUSES as $key => $value) {
            $statuses[$key] = __('moonshine::ui.blog.article.statuses.' . $value);
        }

        return $statuses;
    }
}
