<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameImage extends Model
{
    use HasFactory;
    
    public function  getImageAttribute($val)
    {
        return ($val !== null) ? asset('uploads/games/' . $val) : "";
    }
    
    protected $guarded = [];
}
