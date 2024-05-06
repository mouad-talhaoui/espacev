<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diplome extends Model
{
    use HasFactory;
    
    public function filiere_get_id(){
        return $this->belongsTo(Filiere::class, 'filiere_id', 'filiere_id');
    }
}
