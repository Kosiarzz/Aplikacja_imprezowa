<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'content',
        'content_type',
        'status',
        'shown',
        'created_at',
        'notification_type',
        'notification_id',
    ];

    public function notification()
    {
        return $this->morphTo();
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('id','asc');
    }
}
