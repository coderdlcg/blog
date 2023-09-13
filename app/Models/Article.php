<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use MoonShine\Models\MoonshineUser;

class Article extends Model
{
    use HasFactory;

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

    protected static function boot() : void
    {
        parent::boot();

        static::creating(function (Article $article) {
            $article->slug = $article->slug ?? Str::slug($article->title, '-');
        });
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(MoonshineUser::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class)->latestOfMany();
    }

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
