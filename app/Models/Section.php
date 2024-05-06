<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        "id",
        "code_module",
        "section",
            ];

   public function module_get_id(){
    return $this->belongsTo(Module::class,"code_module","id");
    }
    public function get_all_Ips()
    {
        return $this->hasMany(Ip::class,"id_section","id");
    }
    public function seances()
    {
        return $this->hasMany(Seance::class, 'id_section', 'id');
    }
    public function seancestd()
    {
        return $this->hasMany(SeanceTd::class, 'id_section', 'id');
    }
}
