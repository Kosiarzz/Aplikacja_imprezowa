<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'businesses_categories';
    protected $primaryKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'business_id',
        'category_id',
    ];

    public function category()
    {
        return $this->hasMany(Category::class, 'id');
    }
}
