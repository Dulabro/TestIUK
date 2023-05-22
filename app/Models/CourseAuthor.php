<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAuthor extends Model
{
    use HasFactory;

    protected $table = 'CourseAuthors';

    protected $fillable = [
        'id_course',
        'id_author',
    ];
}
