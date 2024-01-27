<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

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
        return $this->hasMany(GameType::class, 'game_id');
    }

}
