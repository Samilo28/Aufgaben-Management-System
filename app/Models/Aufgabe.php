<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aufgabe extends Model
{
    protected $table = 'aufgaben';
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
