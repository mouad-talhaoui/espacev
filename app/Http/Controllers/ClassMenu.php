<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Etudiant\EtudiantTrait;
use App\Models\Parametre;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ClassMenu
{
    use EtudiantTrait;

    public function compose(View $view): void
    {
        $param_confirm = $this->parameter_confirmation();
        $param_convocation=Parametre::first()->convocation;
        $param_reclamation_note=Parametre::first()->reclamation_note;
        if (Auth::guard('etudiant')->check())
        $view->with(['param_confirm'=>$param_confirm,
        "param_convocation"=>$param_convocation,
        "param_reclamation_note"=>$param_reclamation_note,
    ]);
    }

    private function parameter_confirmation()
    {
        $parameter_confirm = 0;
        if($this->checkconfirmation()==null){
            return $parameter_confirm;
        }else{
            $parameter_confirm = 1;
            return $parameter_confirm;
        }
    }
}
