<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupEvent extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'groups_events';
    
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
        return $this->hasMany(Cost::class, 'group_id');
    }

    public function guests()
    {
        return $this->hasMany(Guest::class, 'group_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'group_id');
    }

    public function groupCategory()
    {
        return $this->hasMany(GroupCategory::class, 'group_id');
    }
}
