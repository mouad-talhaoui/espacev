<?php

namespace App\Http\Controllers\Etudiant;

use PDF;
use App\Models\Ip;
use Carbon\Carbon;
use App\Models\Filiere;
use App\Models\Etudiant;
use App\Models\demendeur;
use App\Models\Parametre;
use App\Models\Convocation;
use App\Models\Confirmation;
use Illuminate\Http\Request;
use App\Models\ReclamationNote;
use App\Http\Controllers\Controller;
use App\Models\att_reussit;
use App\Models\attestation;
use App\Models\bac;
use App\Models\diplome;
use App\Models\releve_note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PHPUnit\Framework\MockObject\Rule\Parameters;

use function PHPUnit\Framework\isNull;

class EtudiantController extends Controller
{
    use EtudiantTrait;
    public function index()
    {
        // $param_confirm = $this->parameter_confirmation();
        $etudiant = Etudiant::with('filiere_get_id')->get();
        $filiere = Filiere::with('etudiants')->get();
        return view('etudiant.index', compact('etudiant', 'filiere'));
    }
    public function profile()
    {
        return view('etudiant.profile');
    }
    public function viewConfirmation()
    {
        // $param_confirm = $this->parameter_confirmation();
        if ($this->checkconfirmation() == null)
            return abort(404);
        $confirm = $this->checkconfirmation()["confirm"];
        return view("etudiant.confirmation", compact('confirm'));
    }

    public function PostConfirmation(Request $request)
    {
        if (Auth::user()->stuation_annuel == "Inscrit" && (Auth::user()->stuation_autmn == "Inscrit" || Auth::user()->stuation_print == "Inscrit")) {
            $data["apogee"] = Auth::guard('etudiant')->user()->id;
            $data["session"] = $this->checkconfirmation()["session"];
            $data["confirm"] = 1;
            Confirmation::create($data);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function ip()
    {
        $queryIps = Ip::where("codeapo", Auth::guard("etudiant")->user()->id)->where("session", "normal")->get();
        return view('etudiant.ip', compact('queryIps'));
    }

    public function convocation()
    {
        $param = Parametre::first();
        if ($param != null  && $param->convocation == 1) {
            $queryConvocation = Convocation::whereIn(
                'id_ip',
                Ip::select('id')->where('codeapo', Auth::guard('etudiant')->user()->id)->get()
            )->where("session", $param->session_examen)->orderBy('id', 'asc')->get();
            return view('etudiant.convocation', compact("queryConvocation"));
        }
        abort(404);
    }
    public function pdfconvocation()
    {
        $param = Parametre::first();
        if ($param != null  && $param->convocation == 1) {
            $queryConvocation = Convocation::whereIn(
                'id_ip',
                Ip::select('id')->where('codeapo', Auth::guard('etudiant')->user()->id)->get()
            )->where("session", $param->session_examen)->orderBy('id', 'asc')->get();
            $qrcode = QrCode::size(100)->generate(
                Auth::guard('etudiant')->user()->id . "\n" .
                    Auth::guard('etudiant')->user()->cne . "\n" . Auth::guard('etudiant')->user()->nom . "\n" .
                    Auth::guard('etudiant')->user()->prenom
            );
            $data = [
                'queryConvocation' => $queryConvocation,
                'qrcode' => $qrcode
            ];
            $pdf = PDF::loadView('etudiant.pdfconvocation', $data);
            return $pdf->stream('pdfconvocation.pdf');
        }
        abort(404);
    }
    public function reclamationNote()
    {
        $param = Parametre::first();
        $queryReclamtionNote = Ip::where("codeapo", Auth::guard("etudiant")->user()->id)->where("session", $param->session_reclamation)->whereNotIn('id', ReclamationNote::select('id_ip')->get())->get();
        $querygetReclamations = ReclamationNote::whereIn('id_ip', Ip::select('id')->where('codeapo', Auth::guard("etudiant")->user()->id)->get())->get();
        return view("etudiant.reclamationNote", compact(['queryReclamtionNote', 'querygetReclamations']));
    }
    public function reclamer(Request $request)
    {
        $request->validate([
            'reclamer' => ["required"],
        ]);
        $countConvocation = Convocation::where('id_ip', $request->reclamer)->count();
        $module = Ip::where('id', $request->reclamer)->first();
        return view("etudiant.reclamationNote_post", compact(['countConvocation', 'module']));
    }
    public function backtoreclamer(Request $request)
    {
        $request->validate([
            'type_reclamation' => ['required'],
        ]);
        $salle = "NULL";
        if ($request->salle != null) {
            $request->validate([
                'salle' => ['required', 'string', 'max:25'],
            ]);
            $salle = $request->salle;
        }
        $data = [
            'salle_examen' => $salle,
            'type_reclamation' => $request->type_reclamation,
            'id_ip' => $request->idip,
            'date_reclamation' => Carbon::now()->format('d/m/Y'), // format date properly
            'codeapo' => Auth::guard("etudiant")->user()->id // Assuming this provides the required value
        ];
        ReclamationNote::create($data);
        return to_route("etudiant.reclamationNote");
    }
    //demandes
    public function demandes()
    {
        $demandes = demendeur::where("codapo", Auth::guard('etudiant')->user()->id)->get();
        $date_delivre = att_reussit::where("codapo", Auth::guard('etudiant')->user()->id)->first();
        $releve_note = releve_note::where("codapo", Auth::guard('etudiant')->user()->id)->first();
        $releve_note_master= releve_note::where("codapo", Auth::guard('etudiant')->user()->id)->first();
        $attestation = attestation::where("codapo", Auth::guard('etudiant')->user()->id)->first();
        $date_retrait = bac::where("cne", Auth::guard('etudiant')->user()->cne)->first();
        $diplomes = diplome::where("codapo", Auth::guard('etudiant')->user()->id)->get();
        $codes_demandes=[];
        foreach ($demandes as $demande) {
            array_push($codes_demandes,$demande["code_demande"]);
        }
        if ($date_delivre != null)
            $date_delivre = $date_delivre->date_delivre;
        if ($date_retrait != null)
            $date_retrait = $date_retrait->date_retrait;
        return view("etudiant.demandes", compact("demandes","attestation" ,"date_delivre","date_retrait","releve_note_master","releve_note","diplomes","codes_demandes"));
    }
    public function demander(Request $request)
    {
        $request->validate([
            'demander' => ["required"],
        ]);
        $demande = [];
        switch ($request->demander) {
            case 'attestation_reussit':
                $demande = ["attestation_reussit", "  شهادة النجاح الفصل الاول والثاني", "Attestation de reussits S1_S2"];
                break;
            case 'attestation_inscription':
                $demande = ["attestation_inscription", "شهادة التسجيل", "Attestation D'Inscription"];
                break;
            case 'retrait_bac':
                $demande = ["retrait_bac", "سحب شهادة الباكلوريا", "Retrait du Baccaluaréat"];
             break;
            case 'releve_note':
                $demande = ["releve_note", "تقديم طلب للحصول على سحب بيان النقط ", "Relevé de Notes"];
                break;
            case 'releve_note_master':
                $demande = ["releve_note_master", "تقديم طلب للحصول على سحب بيان النقط ", "Relevé de Notes"];
                break;
            case 'master':
                $demande = ["master", "سحب شهادة الماستر", "RETRAIT DU DIPLÔME MASTER"];
                break;
            case 'attestation_reussit_master':
                $demande = ["attestation_reussit_master","شهادة النجاح للماستر", "Attestation de Réussite Master "];
                break;
            case 'attestation_master':
                $demande = ["attestation_master","شهادة التسجيل للماستر", "Attestation D'Inscription - Master - "];
                break;
            case 'licence':
                $demande = ["licence"," سحب شهادة الإجازة", "RETRAIT DU DIPLÔME DE LA LICENCE "];
                break;
            case 'deug':
                $demande = ["deug", " سحب دبلوم الدراسات الجامعية العامة", "RETRAIT DU DIPLÔME DEUG"];
                break;
            case 'attestation_licence':
                $demande = ["attestation_licence", "شهادة النجاح للاجازة", "Attestation de Réussite Licence "];
                break;
            case 'attestation_deug':
                $demande = ["attestation_deug", "شهادة النجاح للدراسات الجامعية العامة", "Attestation de Réussite DEUG"];
                break;
            default:
                break;
        }
        return view("etudiant.demandes_post", compact('demande'));
    }
    public function deletedemande($id){
        $demande=demendeur::find($id);
        $demande->delete();
        return back();
    }
    public function backtodemande(Request $request)
    {
        $data=[];
        switch ($request->type_demande) {
            case 'attestation_reussit':
                $data = [
                    'codapo' => Auth::guard("etudiant")->user()->id,
                    'cne' => Auth::guard("etudiant")->user()->cne,
                    'nom' => Auth::guard("etudiant")->user()->nom,
                    'prenom' => Auth::guard("etudiant")->user()->prenom,
                    'type_demande' => $request->type_demande,
                    'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                    'etat_demande' => "encour",
                ];
                break;
                case 'retrait_bac':
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_retrait,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_retrait,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'releve_note':
                    $request->validate([
                        'releve' => ["required"],
                    ]);
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",
                        'releve_note' => $request->releve,

                    ];
                    break;
                case 'releve_note_master':
                    $request->validate([
                        'releve' => ["required"],
                    ]);
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",
                        'releve_note' => $request->releve,

                    ];
                    break;
                case 'deug':
                    $request->validate([
                        'file' => 'required|mimes:pdf|max:2048',
                    ]);
                    $fileName = Auth::guard("etudiant")->user()->id.'.'.$request->file->extension();
                    $request->file->move(public_path('assets\uploads\deug'), $fileName);
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'attestation_inscription':
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'attestation_deug':
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'licence':
                    $request->validate([
                        'file' => 'required|mimes:pdf|max:2048',
                    ]);
                    $fileName = Auth::guard("etudiant")->user()->id.'.'.$request->file->extension();
                    $request->file->move(public_path('assets\uploads\licence'), $fileName);
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'attestation_licence':
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'master':
                    $request->validate([
                        'file' => 'required|mimes:pdf|max:2048',
                    ]);
                    $fileName = Auth::guard("etudiant")->user()->id.'.'.$request->file->extension();
                    $request->file->move(public_path('assets\uploads\master'), $fileName);
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'type_demande' => $request->type_demande,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'attestation_master':
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'type_demande' => $request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
                case 'attestation_reussit_master':
                    $data = [
                        'codapo' => Auth::guard("etudiant")->user()->id,
                        'cne' => Auth::guard("etudiant")->user()->cne,
                        'nom' => Auth::guard("etudiant")->user()->nom,
                        'prenom' => Auth::guard("etudiant")->user()->prenom,
                        'code_demande' => Auth::guard("etudiant")->user()->id."-".$request->type_demande,
                        'type_demande' => $request->type_demande,
                        'etat_demande' => "encour",

                    ];
                    break;
            default:
                # code...
                break;
        }
        demendeur::create($data);
        return to_route("etudiant.demandes");
    }
}
