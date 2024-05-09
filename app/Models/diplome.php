<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diplome extends Model
{
    use HasFactory;
    protected $fillable=["codapo","type_deplome","date_edition","date_retrait","date_deliberation","filiere_id"];
    public function filiere_get_id(){
        return $this->belongsTo(Filiere::class, 'filiere_id', 'filiere_id');
    }
}
