<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_section',
        'id_professeur',
        'id_emploi'

    ];

    public function section_get_id(){
        return $this->belongsTo(Section::class,"id_section","id");
    }
    public function professeur_get_id(){
            return $this->belongsTo(Professeur::class,"id_professeur","id");
    }
    public function plannings()
    {
        return $this->hasMany(Planning::class, 'id_planning', 'id');
    }
    public function emplois()
    {
        return $this->hasMany(Emploi::class, 'id_emploi', 'id');
    }
}
