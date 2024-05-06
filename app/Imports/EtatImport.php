<?php

namespace App\Imports;

use App\Models\demendeur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EtatImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
        public function model(array $row)
        {
            $demande = demendeur::find($row['id']);
            if (!is_null($demande)) {
                $demande->update([
                    'etat_demande' => $row['etat_demande'],
                    'num_archive' => $row['num_archive'],
                 ]);
            }else{
                return "Vérifiez le fichier que vous essayez de télécharger";
            }
        }

}
