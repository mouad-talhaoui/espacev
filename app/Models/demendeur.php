<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demendeur extends Model
{
    use HasFactory;
    protected $fillable = [
        "codapo",
        "cne",
        "nom",
        "prenom",
        "type_demande",
        "num_archive",
        "etat_demande",
        "releve_note",
        "date_retrait",
        "nom_foctionnaire",
        "code_demande"
    ];

    protected $casts = [
        'releve_note' => 'array', // Cast 'data' attribute to an array
    ];
}
