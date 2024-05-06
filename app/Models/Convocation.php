<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ip',
        'id_planning',
        'id_numerotation',
        'session',
    ];

    public function ip_get_id(){
        return $this->belongsTo(Ip::class, 'id_ip', 'id');
    }
    public function planning_get_id(){
        return $this->belongsTo(Planning::class, 'id_planning', 'id');
    }
    public function numerotation_get_id(){
        return $this->belongsTo(Numerotation::class, 'id_numerotation', 'id');
    }
}
