<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{

    use HasFactory;

    protected $fillable =  ["filiere_id",
    "diplom",
    "libelle_diplome",
    "type_fil",
    "code_type"];


public function etudiants()
{
    return $this->hasMany(Etudiant::class, 'filiere_id', 'filiere_id');
}
public function diplomes()
{
    return $this->hasMany(diplome::class, 'filiere_id', 'filiere_id');
}
public function modules()
{
    return $this->hasMany(Module::class, 'filiere_id', 'filiere_id');
}

public function att_reussit()
{
    return $this->hasMany(att_reussit::class, 'filiere_id', 'filiere_id');
}

}
