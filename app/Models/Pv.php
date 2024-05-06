<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pv extends Model
{
    use HasFactory;

    public function planning_get_id(){
        return $this->belongsTo(Planning::class, 'id_planning', 'id');
    }
    public function local_get_id(){
        return $this->belongsTo(local::class, 'id_local', 'id');
    }
    public function surveillances()
    {
        return $this->hasMany(Surveillance::class, 'num_pv', 'num_pv');
    }
}
