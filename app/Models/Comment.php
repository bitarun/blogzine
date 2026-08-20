<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'article_id', 'parent_id', 'body', 'is_approved',
    ];

    public function scopeOnlyApprovedOrOwner($query)
    {
        return $query->whereIsApproved(true)->orWhere('user_id', auth()->id());
    }

    public function scopeWithReplies($query, $depth = 2)
    {
        if ($depth = 0) return $query;

        return $query->with(['replies' => function ($q) use ($depth) {
            $q->onlyApprovedOrOwner()
                ->withReplies($depth - 1)
                ->with(['user.profile:user_id,avatar']);
        }]);
    }

    /* Relation Methods */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /* End Relation Methods */
}
