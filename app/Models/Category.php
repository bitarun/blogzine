<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'en_name', 'description', 'icon', 'slug',
    ];

    public function getRouteKeyName()
    {
        return 'en_name';
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->articles()->delete();
        });
    }

    /* Relation Methods */

    public function articles(): HasMany|Category
    {
        return $this->hasMany(Article::class);
    }

    /* End Relation Methods */
}
