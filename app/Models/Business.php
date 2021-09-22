<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Presenters\BusinessPresenter;

class Business extends Model
{
    use HasFactory;
    use BusinessPresenter;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'shortDescription',
        'priceFrom',
        'priceTo',
        'unit',
        'range',
        'user_id',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'likeable');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function questionsAndAnswers()
    {
        return $this->hasMany(QuestionAndAnswer::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priceFrom','asc');
    }

    public function isLiked()
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }
}
