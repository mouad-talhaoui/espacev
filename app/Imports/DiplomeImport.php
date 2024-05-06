<?php

    namespace App\Imports;

    use App\Models\demendeur;
use App\Models\diplome;
use Illuminate\Support\Collection;
    use Maatwebsite\Excel\Concerns\ToModel;
    use Maatwebsite\Excel\Concerns\ToCollection;
    use Maatwebsite\Excel\Concerns\WithHeadingRow;

    class DiplomeImport implements ToModel,WithHeadingRow
    {
        /**
        * @param Collection $collection
        */
            public function model(array $row)
            {
                $diplome = diplome::find($row['id']);
                if (!is_null($diplome)) {
                    $diplome->update([
                        'date_edition' => $row['date_edition'],
                     ]);
                }else{
                    return "Vérifiez le fichier que vous essayez de télécharger";
                }
            }

    }
