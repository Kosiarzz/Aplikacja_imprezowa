<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
    ];

    public function services()
    {
        return $this->hasManyThrough(Service::class, Business::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
