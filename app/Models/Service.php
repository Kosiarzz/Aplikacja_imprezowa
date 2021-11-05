<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'people_from',
        'people_to',
        'price_from',
        'price_to',
        'unit',
        'size',
        'business_id',
    ];

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notification')->orderBy('id', 'desc');
    }

}
