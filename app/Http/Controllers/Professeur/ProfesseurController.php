<?php

namespace App\Http\Controllers\Professeur;

use App\Http\Controllers\Controller;
use App\Models\Convocation;
use App\Models\Etudiant;
use App\Models\Ip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seance;
use App\Models\ReclamationNote;

class ProfesseurController extends Controller
{
    public function index()
    {
        // Get the logged-in professor
        $professor = Auth::guard("professeur")->user()->id;

        // Fetch seances with corresponding lib_module from modules table
        $seances = Seance::where('id_professeur', $professor)
        ->join('sections', 'seances.id_section', '=', 'sections.id')
        ->join('modules', 'sections.code_module', '=', 'modules.id')
        ->select('seances.*', 'modules.lib_module')
        ->get();

        return view('professeur.reclamations', compact('seances'));
        //return view("professeur.index");
    }

    public function reclamations()
    {
        // Get the logged-in professor
        $professor = Auth::guard("professeur")->user()->id;

        // Fetch seances with corresponding lib_module from modules table
        $seances = Seance::where('id_professeur', $professor)
        ->join('sections', 'seances.id_section', '=', 'sections.id')
        ->join('modules', 'sections.code_module', '=', 'modules.id')
        ->select('seances.*', 'modules.lib_module')
        ->get();

        return view('professeur.reclamations', compact('seances'));
    }

    public function showReclamationList($section)
    {
        //ini_set('max_execution_time',3600);
        // Efficiently fetch reclamation notes for the specified section
        $reclamations = ReclamationNote::whereHas('ip_get_id', function ($query) use ($section) {
            $query->where('id_section', $section);
            $query->where('etat_reclamation', 'En attente de la réponse du professeur');
        })->get();
     

        return view('professeur.reclamations_list', compact('reclamations'));
    }
}
