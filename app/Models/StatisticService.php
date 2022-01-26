<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticService extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'statistics_service';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'views',
        'reservations',
        'date',
        'service_id',
    ];
}
