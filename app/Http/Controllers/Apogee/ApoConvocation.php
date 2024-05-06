<?php

namespace App\Http\Controllers\Apogee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Csv\Reader;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Hash;

use App\Models\local;
use App\Models\Numerotation;
use App\Models\Professeur;
use App\Models\Seance;
use App\Models\Creneau;
use App\Models\Planning;
use App\Models\Convocation;
use App\Models\ReclamationNote;
use App\Models\att_reussit;

class ApoConvocation extends Controller
{

    public function gestion_local()
    {
        return view("apogee.locals");
    }

    public function store_local(Request $request)
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

                local::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'type_local' => $row['type_local'],
                        'centre' => $row['centre'],
                        'capacite' => $row['capacite'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_nums()
    {
        return view("apogee.nums");
    }

    public function store_nums(Request $request)
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

                Numerotation::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'id_local' => $row['id_local'],
                        'numero_place' => $row['numero_place'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_profs()
    {
        return view("apogee.profs");
    }

    public function store_profs(Request $request)
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

                Professeur::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'nom' => $row['nom'],
                        'prenom' => $row['prenom'],
                        'ppr' => $row['ppr'],
                        'cin' => $row['cin'],
                        'email' => $row['email'],
                        'password' => Hash::make($row['ppr']),
                        'password_change' => 'non',
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_seance()
    {
        return view("apogee.seances");
    }

    public function store_seance(Request $request)
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

                Seance::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'id_section' => $row['id_section'],
                        'id_professeur' => $row['id_professeur'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_creneau()
    {
        return view("apogee.creneau");
    }

    public function store_creneau(Request $request)
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

                Creneau::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'date' => $row['date'],
                        'heure' => $row['heure'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_planning()
    {
        return view("apogee.planning");
    }

    public function store_planning(Request $request)
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

                Planning::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'id_creneau' => $row['id_creneau'],
                        'id_seance' => $row['id_seance'],
                        'centre' => $row['centre'],
                        'session' => $row['session'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_convocation()
    {
        return view("apogee.convocation");
    }

    public function store_convocation(Request $request)
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

                Convocation::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'id_ip' => $row['id_ip'],
                        'id_planning' => $row['id_planning'],
                        'id_numerotation' => $row['id_numerotation'],
                        'session' => $row['session'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }

    public function gestion_reclamation_note()
    {
        return view("apogee.reclamation_note");
    }

    public function updateReclamationNotes(Request $request)
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

        // Process records in chunks
        $records->each(function ($row) {
            // Check if the record exists before updating
            $reclamationNote = ReclamationNote::find($row['id']);

            if ($reclamationNote) {
                $reclamationNote->update([
                    'reponse_apogee' => $row['reponse_apogee'],
                    'etat_reclamation' => 'traité',
                ]);
            }
        });

        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));

        return redirect()->back()->with('success', 'CSV update successful!');
    }

    public function gestion_attstation_reussite()
    {
        return view("apogee.attstation_reussite");
    }

    public function store_attstation_reussite(Request $request)
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

                att_reussit::updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'id' => $row['id'],
                        'date_validation' => $row['date_validation'],
                        'codapo' => $row['codapo'],
                        'filiere_id' => $row['filiere_id'],
                    ]
                );
            }
        });
        // Delete the temporary file after processing
        unlink(storage_path("app/{$filePath}"));
        return redirect()->back()->with('success', 'CSV import successful!');
    }
}

?>
