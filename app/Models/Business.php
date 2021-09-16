<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
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
        'shortDescription',
        'priceFrom',
        'priceTo',
        'unit',
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
}
