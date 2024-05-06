<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeanceTd extends Model
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
}
