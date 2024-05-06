<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveillance extends Model
{
    use HasFactory;
public function PV_get_id(){
        return $this->belongsTo(Pv::class, 'num_pv', 'num_pv');
}
}
