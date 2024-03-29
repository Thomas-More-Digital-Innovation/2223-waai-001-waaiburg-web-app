<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $fillable = ["question_list_id", "tree_part_id", "content"];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function questionLists()
    {
        return $this->belongsTo(QuestionList::class)->withDefault();
    }

    public function treeParts() 
    {
        return $this->belongsTo(TreePart::class)->withDefault();
    }
}
