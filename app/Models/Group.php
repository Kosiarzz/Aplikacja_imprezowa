<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'event_id',
    ];

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function groupCategory()
    {
        return $this->hasMany(GroupCategory::class);
    }
}
