<?php

namespace App\Http\Controllers\Fonctionnaire;

use Carbon\Carbon;
use App\Models\bac;
use App\Models\diplome;
use App\Models\demendeur;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\DiplomeImport;
use App\Imports\EtatImport;
use Exception;
use Illuminate\Support\Facades\Auth;


class FonctionnairController extends Controller
{
    public function index()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            $demandes=demendeur::where("etat_demande","encour")->where("type_demande","like","bac_%")->get();
             return view("fonctionnaire.retrait_bac.encour",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "master")
       {
        $demandes=demendeur::where("etat_demande","encour")->where(function ($query) {
        $query->where('type_demande',"attestation_master")
              ->orWhere("type_demande","releve_note_master")
              ->orWhere("type_demande","attestation_reussit_master");
    })->get();
        return view("fonctionnaire.master.encour",compact("demandes"));
       }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "bourse")
        {
            $demandes=demendeur::where("type_demande","bourse")->get();
            return view("fonctionnaire.bourse",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "edition_licence")
        {
            $diplomes=diplome::where("type_deplome","licence")->where("date_edition","NON")
            ->where("date_deliberation",'not like',"NULL")->get();
            return view("fonctionnaire.edition.licence",compact("diplomes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "diplome")
        {
            $demandes=demendeur::where(function ($query) {
                $query->where('etat_demande',"encour");
            })->where(function ($query){
                $query->where('type_demande',"deug")
                ->orWhere("type_demande","master")
                ->orWhere("type_demande","licence");
            })->get();
            return view("fonctionnaire.diplome.encour",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "attestation")
        {
            $demandes=demendeur::where(function ($query) {
                $query->where('etat_demande',"encour");
            })->where(function ($query) {
                $query->where('type_demande',"attestation_inscription")
                      ->orWhere("type_demande","releve_note")
                      ->orWhere("type_demande","attestation_deug")
                      ->orWhere("type_demande","attestation_reussit")
                      ->orWhere("type_demande","attestation_licence");
            })->get();
            return view("fonctionnaire.attestation.encour",compact("demandes"));
        }
        else
        return view("fonctionnaire.index");

    }
   public function to_enatente(){
      if(Auth::guard("fonctionnaire")->user()->tache === "attestation"){
        demendeur::where(function ($query) {
            $query->where('etat_demande',"encour");
        })->where(function ($query) {
            $query->where('type_demande',"attestation_inscription")
                  ->orWhere("type_demande","releve_note")
                  ->orWhere("type_demande","attestation_deug")
                  ->orWhere("type_demande","attestation_reussit")
                  ->orWhere("type_demande","attestation_licence");
        })->update([
            "etat_demande"=>"en_attente",
          ]);
       }
       elseif(Auth::guard("fonctionnaire")->user()->tache === "master"){
            demendeur::where("etat_demande","encour")->where(function ($query) {
            $query->where('type_demande',"attestation_master")
                  ->orWhere("type_demande","releve_note_master")
                  ->orWhere("type_demande","attestation_reussit_master");
                })->update([
                    "etat_demande"=>"en_attente",
                  ]);;
       }
       elseif(Auth::guard("fonctionnaire")->user()->tache === "diplome"){
            demendeur::where("etat_demande","encour")->where(function ($query) {
            $query->where('type_demande',"licence")
                  ->orWhere("type_demande","deug")
                  ->orWhere("type_demande","master");
                })->update([
                    "etat_demande"=>"en_attente",
                  ]);;
       }
       elseif(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
       {
      demendeur::where("etat_demande","encour")->where("type_demande","like","bac_%")->update([
        "etat_demande"=>"en_attente",
      ]);
    }
     return to_route("fonctionnaire.to_enatente");
   }
   public function to_encour(){
    if(Auth::guard("fonctionnaire")->user()->tache === "attestation"){
        demendeur::where(function ($query) {
            $query->where('etat_demande',"en_attente");
        })->where(function ($query) {
            $query->where('type_demande',"attestation_inscription")
                  ->orWhere("type_demande","releve_note")
                  ->orWhere("type_demande","attestation_deug")
                  ->orWhere("type_demande","attestation_reussit")
                  ->orWhere("type_demande","attestation_licence");
        })->update([
            "etat_demande"=>"encour",
          ]);
       }elseif(Auth::guard("fonctionnaire")->user()->tache === "master"){
        demendeur::where("etat_demande","en_attente")->where(function ($query) {
        $query->where('type_demande',"attestation_master")
              ->orWhere("type_demande","releve_note_master")
              ->orWhere("type_demande","attestation_reussit_master");
            })->update([
                "etat_demande"=>"encour",
              ]);;
       }elseif(Auth::guard("fonctionnaire")->user()->tache === "diplome"){
        demendeur::where("etat_demande","en_attente")->where(function ($query) {
        $query->where('type_demande',"licence")
              ->orWhere("type_demande","deug")
              ->orWhere("type_demande","master");
            })->update([
                "etat_demande"=>"encour",
              ]);;
        }
       elseif(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
         {
            demendeur::where("etat_demande","en_attente")->where("type_demande","like","bac_%")->update([
                "etat_demande"=>"encour",
            ]);
         }
     return to_route("fonctionnaire.index");
   }
    public function enattente()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            $demandes=demendeur::where("etat_demande","en_attente")->where("type_demande","like","bac_%")->get();;
             return view("fonctionnaire.retrait_bac.enattente",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "master")
        {
         $demandes=demendeur::where("etat_demande","en_attente")->where(function ($query) {
         $query->where('type_demande',"attestation_master")
               ->orWhere("type_demande","releve_note_master")
               ->orWhere("type_demande","attestation_reussit_master");
     })->get();
         return view("fonctionnaire.master.enattente",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "attestation")
        {
            $demandes=demendeur::where(function ($query) {
                $query->where('etat_demande',"en_attente");
            })->where(function ($query) {
                $query->where('type_demande',"attestation_inscription")
                      ->orWhere("type_demande","releve_note")
                      ->orWhere("type_demande","attestation_deug")
                      ->orWhere("type_demande","attestation_reussit")
                      ->orWhere("type_demande","attestation_licence");
            })->get();
            // $demandes=demendeur::where("etat_demande","en_attente")->where("type_demande","attestation_inscription")->orWhere("type_demande","attestation_reussit")->orWhere("type_demande","releve_note")->orWhere("type_demande","attestation_deug")->orWhere("type_demande","attestation_licence")->get();
            return view("fonctionnaire.attestation.enattente",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "diplome")
        {
            $demandes=demendeur::where(function ($query) {
                $query->where('etat_demande',"en_attente");
            })->where(function ($query) {
                $query->where('type_demande',"master")
                      ->orWhere("type_demande","deug")
                      ->orWhere("type_demande","licence");
            })->get();
            // $demandes=demendeur::where("etat_demande","en_attente")->where("type_demande","attestation_inscription")->orWhere("type_demande","attestation_reussit")->orWhere("type_demande","releve_note")->orWhere("type_demande","attestation_deug")->orWhere("type_demande","attestation_licence")->get();
            return view("fonctionnaire.diplome.enattente",compact("demandes"));
        }
    }
    public function pret()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            $demandes=demendeur::where("etat_demande","pret")->where("type_demande","like","bac_%")->get();
             return view("fonctionnaire.retrait_bac.pret",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "master")
        {
         $demandes=demendeur::where("etat_demande","pret")
         ->where(function ($query){
            $query->where('code_demande',"not like","NULL");
        })->where(function ($query){
         $query->where('type_demande',"attestation_master")
               ->orWhere("type_demande","releve_note_master")
               ->orWhere("type_demande","attestation_reussit_master");
          })->get();
         return view("fonctionnaire.master.pret",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "diplome")
        {
         $demandes=demendeur::where("etat_demande","pret")
         ->where(function ($query){
            $query->where('code_demande',"not like","NULL");
        })->where(function ($query) {
         $query->where('type_demande',"licence")
               ->orWhere("type_demande","deug")
               ->orWhere("type_demande","master");
          })->get();
         return view("fonctionnaire.master.pret",compact("demandes"));
        }
        elseif(Auth::guard("fonctionnaire")->user()->tache === "attestation")
        {
            $demandes=demendeur::where(function ($query) {
                $query->where('etat_demande',"pret");
            })->where(function ($query){
                $query->where('code_demande',"not like","NULL");
            })->where(function ($query) {
                $query->where('type_demande',"attestation_inscription")
                      ->orWhere("type_demande","releve_note")
                      ->orWhere("type_demande","attestation_deug")
                      ->orWhere("type_demande","attestation_reussit")
                      ->orWhere("type_demande","attestation_licence");
            })->get();
            return view("fonctionnaire.attestation.pret",compact("demandes"));
        }
    }
    public function refus()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            $demandes=demendeur::where("etat_demande","refusé")->where("type_demande","like","bac_%")->get();
             return view("fonctionnaire.retrait_bac.refus",compact("demandes"));
        }
    }
    public function traite_bac($id,Request $request){
        $request->validate([
            'num_arrchive' => ["required"],
        ]);
        $demande = demendeur::find($id);
        $demande->num_archive=$request->num_arrchive;
        $demande->etat_demande="pret";
        $demande->date_retrait=Carbon::now()->format('Y-m-d');
        $demande->nom_foctionnaire=Auth::guard("fonctionnaire")->user()->nom;
        $demande->save();
        return back();

    }
    public function retourbac()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            $demandes=demendeur::where("etat_demande","delevré")->where("date_retrait","NULL")->where("type_demande","like","bac_%")->where("code_demande","not like","NULL")->get();
             return view("fonctionnaire.retrait_bac.retourbac",compact("demandes"));
        }
    }
    public function rp()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            $demandes=demendeur::where("date_retrait","not like","NULL")->where("type_demande","bac_rp")->get();
             return view("fonctionnaire.retrait_bac.rp",compact("demandes"));
        }
    }
    public function rdc()
    {
        if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac")
        {
            demendeur::where("etat_demande","pret")->where("type_demande","like","bac_rdc")->update([
                "etat_demande"=>"delevré"
            ]);
            $demandes=demendeur::where("date_retrait","not like","NULL")->where("etat_demande","delevré")->where("type_demande","bac_rdc")->get();
             return view("fonctionnaire.retrait_bac.rdc",compact("demandes"));
        }
    }
    public function retour_bac($id){
        $demande = demendeur::find($id);
        $demande->etat_demande="delevré";
        $demande->date_retrait ="NULL";
        $demande->nom_foctionnaire=Auth::guard("fonctionnaire")->user()->nom;
        $demande->save();
        return back();
    }
    public function refus_bac($id){
        $demande = demendeur::find($id);
        $demande->etat_demande="refusé";
        $demande->save();
        return back();

    }
    public function activer_between(Request $request){

    if(Auth::guard("fonctionnaire")->user()->tache === "retrait_bac"){
        $request->validate([
            'date_debut' => ["required"],
            'date_fin' => ["required"],
        ]);
        $startDate = $request->date_debut;
        $endDate =$request->date_fin;
        demendeur::where("type_demande","like","bac_%")->where('created_at', '>=', $startDate)
           ->where('created_at', '<=', $endDate)
           ->update([
            "code_demande"=>"NULL"
           ]);
        }elseif(Auth::guard("fonctionnaire")->user()->tache === "attestation"){
            $startDate = $request->date_debut;
            $endDate =$request->date_fin;
            demendeur::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)
              ->where('type_demande',$request->myOption)->update([
                "code_demande"=>"NULL"
              ]);
        }elseif(Auth::guard("fonctionnaire")->user()->tache === "master"){
            $startDate = $request->date_debut;
            $endDate =$request->date_fin;
            demendeur::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)
              ->where('type_demande',$request->myOption)->update([
                "code_demande"=>"NULL"
              ]);
        }
           return back()->with('success', 'Toutes les demandes entre '. $startDate.' et '.$endDate.' ont été activeés! ');;
    }
    public function activer_seul_bac($id){
        $demande = demendeur::find($id);
        $demande->code_demande ="NULL";
        $demande->nom_foctionnaire=Auth::guard("fonctionnaire")->user()->nom;
        $demande->save();
        return back();
    }
    public function bac_expiree(){
        demendeur::where("etat_demande","delevré")->where("date_retrait","NULL")->where("type_demande","like","bac_%")->where("code_demande","NULL")->delete();
        return back()->with('success', 'Toutes les demandes expirées ont été supprimées!');
    }
    public function excel_traite(Request $request){
        try{
        $request->validate([
            'excel_traite' => 'required|mimes:xlsx,xls' // Validation for Excel file type
        ]);
        $result=Excel::import(new EtatImport, $request->file('excel_traite'));
        if (is_string($result)) {
            return redirect()->route("fonctionnaire.to_enatente")->with(
            [
            "alert"=>'danger',
             "msg"=>$result]);
        }
        return redirect()->back()->with([
            "alert"=>'success',
            "msg"=>'Import successful'
    ]);
       }catch(Exception $e){
        return redirect()->route("fonctionnaire.to_enatente")->with([
        'alert'=>'danger',
        'msg'=>"Assurez-vous d'écrire (pret ou refusé) de cette façon" ]);
       }
    }
    public function excel_diplome(Request $request){
        try{

        $request->validate([
            'excel_diplome' => 'required|mimes:xlsx,xls' // Validation for Excel file type
        ]);
        $result=Excel::import(new DiplomeImport, $request->file('excel_diplome'));
        if (is_string($result)) {
            return redirect()->route("fonctionnaire.to_enatente")->with(
            [
            "alert"=>'danger',
             "msg"=>$result 
            ]);
        }
        return redirect()->back()->with([
            "alert"=>'success',
            "msg"=>'Import successful'
    ]);
       }catch(Exception $e){
        return redirect()->back()->with([
        'alert'=>'danger',
        'msg'=>"Assurez-vous d'écrire (pret ou refusé) de cette façon" ]);
       }
    }
}
