<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'driver_name',
        'driver_id',
        'user_id',
        'avatar',
        'article_id',
        'body',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    /* Accessor Methods */
    public function getRoleFaAttribute(): string
    {
        $roles = [
            'admin' => 'مدیر',
            'subscriber' => 'مشترک',
            'author' => 'نویسنده',
        ];

        return $roles[$this->role];
    }

    public function getStatusAttribute(): string
    {
        return $this->email_verified_at ? 'فعال' : 'غیرفعال';
    }

    public function getJalaliDateAttribute(): string
    {
        return verta($this->created_at)->format('d F Y');
    }

    /* End Accessor Methods */



    /* Relation Methods */

    public function articles(): User|HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function profile(): HasOne|User
    {
        return $this->hasOne(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* End Relation Methods */
}
