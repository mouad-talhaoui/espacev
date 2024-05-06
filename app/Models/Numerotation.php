<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numerotation extends Model
{
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'id_local',
        'numero_place',
    ];

    use HasFactory;
    public function local_get_id(){
        return $this->belongsTo(local::class, 'id_local', 'id');
    }
    public function convocations()
    {
        return $this->hasMany(Convocation::class, 'id_ip', 'id');
    }
}
