<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class releve_note extends Model
{
    use HasFactory;
    protected $fillable = [
        "codapo",
        "releve_note",
    ];

    protected $casts = [
        'releve_note' => 'array', // Cast 'data' attribute to an array
    ];
}
