<?php

namespace App\Imports;

use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class EtudiantsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    private $duplicateEntries = [];
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $existingEtudiant = Etudiant::where('id', $row['id'])->first();

        if ($existingEtudiant) {
            // This ID already exists in the database, skip processing this row
            $this->duplicateEntries[] = $row['id'];
            return null;
        }

        // No duplicate found, proceed with creating the Etudiant model
        return new Etudiant([
            'id' => $row['id'],
            'cne' => $row['cne'],
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'password' => Hash::make($row['id']),
            'password_change' => 'non',
            'stuation_annuel' => $row['stuation_annuel'],
            'stuation_autmn' => $row['stuation_autmn'],
            'stuation_print' => $row['stuation_print'],
            'filiere_id' => $row['filiere_id'],
            'diplome' => $row['diplome'],
        ]);
    }

    public function batchSize(): int
    {
        return 60;
    }

    public function chunkSize(): int
    {
        return 60;
    }

    public function chunkBefore(iterable $rows)
    {
        // After each chunk is processed, check for duplicate entries
        // and store them in the $duplicateEntries array
        foreach ($rows as $row) {
            $existingEtudiant = Etudiant::where('id', $row['id'])->first();

            if ($existingEtudiant) {
                $this->duplicateEntries[] = $row['id'];
            }
        }
    }

    public function finish(Request $request)
    {
        // Store the duplicate entries in the session for access in the view
        $request->session()->put('duplicateEntries', $this->duplicateEntries);
    }
}
