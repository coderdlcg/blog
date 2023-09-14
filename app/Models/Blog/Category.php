<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'parent_id', 'desc', 'sorting'];

    public function articles() : BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
