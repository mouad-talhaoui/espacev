<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;
    public function local_get_id(){
        return $this->belongsTo(local::class, 'id_local', 'id');
    }
    public function seance_get_id(){
        return $this->belongsTo(Seance::class, 'id_seance', 'id');
    }
}
