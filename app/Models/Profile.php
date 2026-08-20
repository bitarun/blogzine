<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'avatar', 'bio', 'social_links', 'availability'];

    protected $casts = ['social_links' => 'array'];

    public function getAvatarImageAttribute()
    {
        return $this->avatar ? $this->avatar : 'avatar.png';
    }

    /* Relation Methods */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* End Relation Methods */
}
