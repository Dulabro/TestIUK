<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_test', // Add id_test to the fillable property
        'id_user',
        'totalValue',
    ];
}
