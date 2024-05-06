<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReclamationNote extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_ip",
        "codeapo",
        "date_reclamation",
        "salle_examen",
        "reponse_apogee",
        "type_reclamation",
        "etat_reclamation"
            ];

    public function ip_get_id(){
        return $this->belongsTo(Ip::class, 'id_ip', 'id');
    }
}
