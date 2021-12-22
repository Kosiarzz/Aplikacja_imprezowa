<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBusiness extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'groups_businesses';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'business_id',
    ];

    public function groupCategory()
    {
        return $this->hasMany(GroupCategory::class, 'group_id');
    }
}
