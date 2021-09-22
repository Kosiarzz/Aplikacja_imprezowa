<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAndAnswer extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'questions_and_answers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'question',
        'answer',
        'business_id',
    ];

}
