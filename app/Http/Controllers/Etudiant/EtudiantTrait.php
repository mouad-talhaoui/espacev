<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\Parametre;
use App\Models\Confirmation;
use App\Models\Convocation;
use Illuminate\Support\Facades\Auth;

trait EtudiantTrait
{

public function checkconfirmation(){
        $confirm=0;
        $param=Parametre::first();
        if($param !=null){
            if($param->confirmation){
                $session=$param->session;
                $checkSession=Confirmation::where("session",$session)->where("Apogee",Auth::guard("etudiant")->user()->id)->first();
                if($checkSession !=null)
                    $confirm=$checkSession->confirm;
                return array('confirm'=>$confirm,'session'=>$session);
            }
            return null;
        }
        return null;
    }

}
