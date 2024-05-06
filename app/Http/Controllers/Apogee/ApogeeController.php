<?php

namespace App\Http\Controllers\Apogee;

use App\Models\Module;
use League\Csv\Reader;
use App\Models\Filiere;
use App\Models\Section;
use App\Models\Etudiant;
use App\Models\Parametre;
use App\Models\Ip;
use App\Models\Confirmation;
use App\Models\ReclamationNote;
use Illuminate\Http\Request;
use App\Imports\EtudiantsImport;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\LazyCollection;

class ApogeeController extends Controller
{
    public function index()
    {
        $filieresCount = Filiere::count();
        return view("apogee.index", compact('filieresCount'));
    }

    public function confirmation()
    {
    $parametre=Parametre::first();
     return view("apogee.confirmation",compact("parametre"));
    }
    public function checkconfirm(Request $request){

    $confirmation = $request->has('checkboxconfirmation') ? $request->checkboxconfirmation : false;

    Parametre::whereId($request->id)->update([
        'confirmation' => $confirmation,
        'session' => $request->radiosession,
    ]);

    return redirect()->back()->with('success', 'Les modifications ont été enregistrées avec succès');
    }

    public function checkconvocation(Request $request){

        $convocation = $request->has('checkboxconvocation') ? $request->checkboxconvocation : false;

        Parametre::whereId($request->id)->update([
            'convocation' => $convocation,
            'session_examen' => $request->session_examen,
        ]);

        return redirect()->back()->with('success', 'Les modifications ont été enregistrées avec succès');
    }
    public function checkreclamtionnote(Request $request){

        $reclamation_note = $request->has('checkboxreclamation') ? $request->checkboxreclamation : false;

        Parametre::whereId($request->id)->update([
            'reclamation_note' => $reclamation_note,
            'session_reclamation' => $request->session_reclamation, 
        ]);

        return redirect()->back()->with('success', 'Les modifications ont été enregistrées avec succès');
    }

    public function gestion_etudiants()
    {
        return view("apogee.etudiants");
    }

    public function store_etudiants(Request $request)
    {
        // Disable the maximum execution time limit
        set_time_limit(0);
        // Validate the uploaded file, ensure it's a CSV file, etc.
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Save the uploaded file to a temporary location
        $file = $request->file('import_file');
        $filePath = $file->storeAs('temp', 'import.csv');

        $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
        $csv->setHeaderOffset(0); // Adjust the header offset if your CSV has headers

        // Create LazyCollection from the CSV file
        $records = LazyCollection::make(function () use ($csv) {
            foreach ($csv->getRecords() as $record) {
                yield $record;
            }
        });

        // Chunk size for processing in batches
        $chunkSize = 100;

        // Process records in chunks
        $records->chunk($chunkSize)->each(function ($chunk) {
            foreach ($chunk as $row) {

                Etudiant::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'cne' => $row['cne'],
                        'cin' => $row['cin'],
                        'email' => $row['email'],
                        'nom' => $row['nom'],
                        'prenom' => $row['prenom'],
                        'password' => Hash::make($row['password']),
                        'date_naissance' => $row['date_naissance'],
                        'password_change' => 'non',
                        'stuation_annuel' => $row['stuation_annuel'],
                        'stuation_autmn' => $row['stuation_autmn'],
                        'stuation_print' => $row['stuation_print'],
                        'filiere_id' => $row['filiere_id'],
                        'diplome' => $row['diplome'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_sections()
    {
        return view("apogee.sections");
    }

    public function store_sections(Request $request)
    {
        // Disable the maximum execution time limit
        set_time_limit(0);
        // Validate the uploaded file, ensure it's a CSV file, etc.
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Save the uploaded file to a temporary location
        $file = $request->file('import_file');
        $filePath = $file->storeAs('temp', 'import.csv');

       // Use the Reader with setDelimiter
        $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
        $csv->setHeaderOffset(0); // Adjust the header offset if your CSV has headers

        // Create LazyCollection from the CSV file
        $records = LazyCollection::make(function () use ($csv) {
            foreach ($csv->getRecords() as $record) {
                yield $record;
            }
        });

        // Chunk size for processing in batches
        $chunkSize = 100;

        // Process records in chunks
        $records->chunk($chunkSize)->each(function ($chunk) {
            foreach ($chunk as $row) {

                Section::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'code_module' => $row['code_module'],
                        'section' => $row['section'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));

        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_filieres()
    {
        return view("apogee.filieres");
    }

    public function store_filieres(Request $request)
    {
        // Disable the maximum execution time limit
        set_time_limit(0);
        // Validate the uploaded file, ensure it's a CSV file, etc.
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Save the uploaded file to a temporary location
        $file = $request->file('import_file');
        $filePath = $file->storeAs('temp', 'import.csv');

       // Use the Reader with setDelimiter
        $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
        $csv->setHeaderOffset(0); // Adjust the header offset if your CSV has headers

        // Create LazyCollection from the CSV file
        $records = LazyCollection::make(function () use ($csv) {
            foreach ($csv->getRecords() as $record) {
                yield $record;
            }
        });

        // Chunk size for processing in batches
        $chunkSize = 100;

        // Process records in chunks
        $records->chunk($chunkSize)->each(function ($chunk) {
            foreach ($chunk as $row) {

                Filiere::updateOrCreate(
                    ['filiere_id' => $row['filiere_id']],
                    [
                        'diplom' => $row['diplom'],
                        'libelle_diplome' => $row['libelle_diplome'],
                        'type_fil' => $row['type_fil'],
                        'code_type' => $row['code_type'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));

        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_modules()
    {
        return view("apogee.modules");
    }

    public function store_modules(Request $request)
    {
        // Disable the maximum execution time limit
        set_time_limit(0);
        // Validate the uploaded file, ensure it's a CSV file, etc.
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Save the uploaded file to a temporary location
        $file = $request->file('import_file');
        $filePath = $file->storeAs('temp', 'import.csv');

       // Use the Reader with setDelimiter
        $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
        $csv->setHeaderOffset(0); // Adjust the header offset if your CSV has headers

        // Create LazyCollection from the CSV file
        $records = LazyCollection::make(function () use ($csv) {
            foreach ($csv->getRecords() as $record) {
                yield $record;
            }
        });

        // Chunk size for processing in batches
        $chunkSize = 100;

        // Process records in chunks
        $records->chunk($chunkSize)->each(function ($chunk) {
            foreach ($chunk as $row) {

                Module::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'filiere_id' => $row['filiere_id'],
                        'semester' => $row['semester'],
                        'lib_module' => $row['lib_module'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));

        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_ips()
    {
        return view("apogee.ips");
    }

    public function store_ips(Request $request)
    {
        // Disable the maximum execution time limit
        set_time_limit(0);
        // Validate the uploaded file, ensure it's a CSV file, etc.
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Save the uploaded file to a temporary location
        $file = $request->file('import_file');
        $filePath = $file->storeAs('temp', 'import.csv');

       // Use the Reader with setDelimiter
        $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
        $csv->setHeaderOffset(0); // Adjust the header offset if your CSV has headers

        // Create LazyCollection from the CSV file
        $records = LazyCollection::make(function () use ($csv) {
            foreach ($csv->getRecords() as $record) {
                yield $record;
            }
        });

        // Chunk size for processing in batches
        $chunkSize = 100;

        // Process records in chunks
        $records->chunk($chunkSize)->each(function ($chunk) {
            foreach ($chunk as $row) {

                Ip::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'id_section' => $row['id_section'],
                        'codeapo' => $row['codeapo'],
                        'session' => $row['session'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));

        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_recl_notes()
    {
        return view("apogee.notes");
    }

    public function store_recl_notes(Request $request)
    {
        // Disable the maximum execution time limit
        set_time_limit(0);
        // Validate the uploaded file, ensure it's a CSV file, etc.
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Save the uploaded file to a temporary location
        $file = $request->file('import_file');
        $filePath = $file->storeAs('temp', 'import.csv');

       // Use the Reader with setDelimiter
        $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
        $csv->setHeaderOffset(0); // Adjust the header offset if your CSV has headers

        // Create LazyCollection from the CSV file
        $records = LazyCollection::make(function () use ($csv) {
            foreach ($csv->getRecords() as $record) {
                yield $record;
            }
        });

        // Chunk size for processing in batches
        $chunkSize = 100;

        // Process records in chunks
        $records->chunk($chunkSize)->each(function ($chunk) {
            foreach ($chunk as $row) {

                ReclamationNote::where('id', $row['id'])->first()->update([
                    'etat_reclamation' => 'Traitée',
                    'reponse_apogee' => $row['reponse_apogee'],
                ]);
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));

        return redirect()->back()->with('success', 'CSV import successful!');
    }
}
