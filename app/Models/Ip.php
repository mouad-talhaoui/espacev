<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ip extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'id_section',
        'codeapo',
        'session',
    ];

   public function section_get_id(){
        return $this->belongsTo(Section::class,"id_section","id");
    }
   public function etudiant_get_id(){
        return $this->belongsTo(Etudiant::class,"codeapo","id");
    }
    public function convocations()
    {
        return $this->hasMany(Convocation::class, 'id_ip', 'id');
    }
    public function reclamationsNotes()
    {
        return $this->hasMany(ReclamationNote::class, 'id_ip', 'id');
    }
}
