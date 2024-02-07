<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCourses extends Model
{
    use HasFactory;
    public function group(){
        return $this->belongsTo(Group::class , 'group_id');
    }

    public function program(){
        return $this->belongsTo(Program::class , 'program_id');
    }
}
