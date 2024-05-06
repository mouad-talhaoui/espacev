<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class observateur extends Model
{
    use HasFactory;
    protected $fillable=["id_doctrant","id_planning","local_id"];
    public function doctrant_get_id(){
        return $this->belongsTo(Doctrant::class, 'id_doctrant', 'id');
    }
    public function planning_get_id(){
        return $this->belongsTo(Planning::class, 'id_planning', 'id');
    }
    public function local_get_id(){
        return $this->belongsTo(local::class, 'local_id', 'id');
    }
}
