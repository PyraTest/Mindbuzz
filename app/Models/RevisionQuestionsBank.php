<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionQuestionsBank extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class, "bank_id");
    }
}
