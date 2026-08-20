<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'title', 'slug', 'type', 'category_id', 'description', 'body', 'tags', 'thumbnails', 'status',
        'user_id',
        'parent_id',
    ];

    protected $casts = [
        'thumbnails' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /* Accessor Methods */

    public function getMdThumbAttribute()
    {
        return $this->thumbnails['medium'] ?? 'md_thumb.png';
    }

    public function getLgThumbAttribute()
    {
        return $this->thumbnails['large'] ?? 'lg_thumb.png';
    }

    public function getSmThumbAttribute()
    {
        return $this->thumbnails['small'] ?? 'sm_thumb.png';
    }

    public function description(): Attribute
    {
        return Attribute::make(fn($value) => $value ?? '');
    }

    public function commentsCount(): Attribute
    {
        return Attribute::make(fn() => $this->comments()->where('is_approved', true)->count());
    }
    /* End Accessor Methods */



    /* Mutator Methods */

    protected function slug(): Attribute
    {
        return Attribute::make(set: fn($value) => makeSlug($value ?? $this->title));
    }

    /* End Mutator Methods */




    /* Relation Methods */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* End Relation Methods */
}
