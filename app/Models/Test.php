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
    public static function getTypeLabels()
    {
        return [
            self::TYPE_TEST => 'Test',
            self::TYPE_QUIZ => 'Quiz',
            self::TYPE_HOMEWORK => 'Homework',
        ];
    }
}
