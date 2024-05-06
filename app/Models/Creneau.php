<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creneau extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'heure',
    ];

    public function plannings()
    {
        return $this->hasMany(Planning::class, 'id_creneau', 'id');
    }
}
