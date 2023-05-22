<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'id_lessons'];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'id_lessons');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
