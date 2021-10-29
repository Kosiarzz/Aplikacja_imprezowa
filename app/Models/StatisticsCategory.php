<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticsCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'statistics_category';
    protected $primaryKey = 'category_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'category_id',
        'stats',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id');
    }
}