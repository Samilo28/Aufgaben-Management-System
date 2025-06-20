<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aufgabe extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
