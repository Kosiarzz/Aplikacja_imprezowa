<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function businesses()
    {
        return $this->morphedByMany(Business::class, 'likeable');
    }

    public function photos()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function userData()
    {
        return $this->hasOne(UserData::class);
    }

    public function isAdmin()
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isModerator()
    {
        return $this->role === UserRole::MODERATOR;
    }
}
