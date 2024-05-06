<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_creneau',
        'id_seance',
        'centre',
        'session',
    ];

    public function creneau_get_id(){
        return $this->belongsTo(Creneau::class, 'id_creneau', 'id');
    }
    public function seance_get_id(){
        return $this->belongsTo(Seance::class, 'id_seance', 'id');
    }
    public function convocations()
    {
        return $this->hasMany(Convocation::class, 'id_ip', 'id');
    }
    public function observateurs()
    {
        return $this->hasMany(observateur::class, 'id_planning', 'id');
    }
}
