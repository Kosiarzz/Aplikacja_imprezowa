<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'budget',
        'date_event',
        'category_id',
        'user_id' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
