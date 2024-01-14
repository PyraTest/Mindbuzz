<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    const TYPE_TEST = 0;
    const TYPE_QUIZ = 1;
    const TYPE_HOMEWORK = 2;
    protected $fillable = ['type']; // Adjust as needed
}
