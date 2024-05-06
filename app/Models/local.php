<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'type_local',
        'centre',
        'capacite',
    ];

    public function numerotations()
    {
        return $this->hasMany(Numerotation::class, 'id_local', 'id');
    }
    public function observateurs()
    {
        return $this->hasMany(observateur::class, 'id_local', 'id');
    }
    public function emplois()
    {
        return $this->hasMany(Emploi::class, 'id_local', 'id');
    }
}
