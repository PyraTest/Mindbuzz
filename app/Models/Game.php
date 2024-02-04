<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function gameImages()
    {
        return $this->hasMany(GameImage::class, 'game_id');
    }
    public function gameLetters()
    {
        return $this->hasMany(GameLetter::class, 'game_id');
    }
    public function gameLettersDistinct()
    {
        return $this->hasMany(GameLetter::class, 'game_id');
    }
    public function gameTypes()
    {
        return $this->belongsTo(GameType::class, 'game_type_id');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
