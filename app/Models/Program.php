<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course_id',
        'school_id',
        'stage_id',
      
    ];
    public function school(){
        return $this->belongsTo(School::class , 'school_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class , 'stage_id');
    }
    public function course(){
        return $this->belongsTo(Course::class , 'course_id');
    }

}
