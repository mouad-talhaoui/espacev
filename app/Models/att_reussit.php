<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class att_reussit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_validation',
        'date_delivre',
        'codapo',
        'filiere_id',
    ];

    public function filiere_get_id(){
        return $this->belongsTo(Filiere::class, 'filiere_id', 'filiere_id');
    }
}
