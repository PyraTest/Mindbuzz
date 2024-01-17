<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'warmup_id',
        'unit_id',
    ];
    public function warmup(){
        return $this->belongsTo(Warmup::class , 'warmup_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class , 'unit_id');
    }
}
