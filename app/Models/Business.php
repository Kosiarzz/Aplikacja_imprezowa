<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'name',
        'title',
        'description',
        'short_description',
        'user_id',
        'city_id',
        'rating',
    ];

    public function groupBusiness()
    {
        return $this->hasMany(GroupBusiness::class, 'business_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function contactable()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function notification()
    {
        return $this->morphMany(Notification::class, 'notification');
    }

    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function openingHours()
    {
        return $this->hasOne(OpeningHours::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function statistic()
    {
        return $this->hasMany(Service::class);
    }

    public function questionsAndAnswers()
    {
        return $this->hasMany(QuestionAndAnswer::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name','asc');
    }

    public function isLiked()
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }

    public function categories()
    {
        return $this->hasMany(BusinessCategory::class);
    }

    public function mainCategory()
    {
        return $this->belongsTo(Category::class);
    }
}
