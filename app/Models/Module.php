<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'filiere_id',
        'diplome',
        'semester',
        "filiere_id",
        'lib_module',
    ];

    public function get_all_Section()
    {
    return $this->hasMany(Ip::class,"code_module","id");
    }
    public function filiere_get_id(){
        return $this->belongsTo(Filiere::class, 'filiere_id', 'filiere_id');
    }
}
