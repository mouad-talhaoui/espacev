<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Etudiant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded= [];

    protected $fillable = [
"id",
"cne",
"cin",
"nom",
"prenom",
"email",
"password",
"date_naissance",
"password_change",
"stuation_annuel",
"stuation_autmn",
"stuation_print",
"filiere_id",
"diplome",
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function filiere_get_id(){
        return $this->belongsTo(Filiere::class, 'filiere_id', 'filiere_id');
    }
    public function get_all_Ips()
    {
        return $this->hasMany(Ip::class,"codeapo","id");
    }
}
