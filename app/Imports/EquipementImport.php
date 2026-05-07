<?php

namespace App\Imports;

use App\Models\Equipement;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class EquipementImport implements ToModel, WithHeadingRow, WithEvents
{
    protected $userId;
    protected $directionId;
    protected $baseUrl;

    protected $tempEquipements = [];

    public function __construct($userId, $directionId, $baseUrl)
    {
        $this->userId = $userId;
        $this->directionId = $directionId;
        $this->baseUrl = $baseUrl;
    }

    public function model(array $row)
    {
        // Vérification unicité numéro de série
        if (Equipement::where('numero_serie', $row['numero_serie'])->exists()) {
            throw ValidationException::withMessages([
                'numero_serie' => 'Le numéro de série "' . $row['numero_serie'] . '" existe déjà.',
            ]);
        }

        // Vérification unicité adresse MAC
        if (Equipement::where('adresse_mac', $row['adresse_mac'])->exists()) {
            throw ValidationException::withMessages([
                'adresse_mac' => 'L’adresse MAC "' . $row['adresse_mac'] . '" existe déjà.',
            ]);
        }

        $equipement = new Equipement([
            'des_equipement'     => $row['des_equipement'],
            'marque'             => $row['marque'],
            'modele'             => $row['modele'],
            'categorie'          => $row['categorie'],
            'nature'             => $row['nature'],
            'num_inventaire'     => $row['num_inventaire'],
            'adresse_mac'        => $row['adresse_mac'],
            'numero_serie'       => $row['numero_serie'],
            'date_acquis'        => $row['date_acquis'],
            'capacite'           => $row['capacite'],
            'ram'                => $row['ram'],
            'source_acquisition' => $row['source_acquisition'],
            'nom_fn'             => $row['nom_fn'],
            'processeur'         => $row['processeur'],
            'systeme'            => $row['systeme'],
            'etat'               => $row['etat'],
            'statut'             => $row['statut'],
            'user_id'            => $this->userId,
            'direction_id'       => $this->directionId,
        ]);

        $this->tempEquipements[] = $equipement;

        return $equipement;
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {
                foreach ($this->tempEquipements as $equipement) {
                    // On retrouve l’équipement par numéro d’inventaire
                    $persisted = Equipement::where('num_inventaire', $equipement->num_inventaire)->first();

                    if ($persisted) {
                        $qrData = $this->baseUrl . route('equipement.details', $persisted->id, false);
                        $qrImage = QrCode::format('svg')->size(200)->generate($qrData);

                        $fileName = 'qrcodes/equipement_' . $persisted->id . '.svg';
                        Storage::disk('public')->put($fileName, $qrImage);

                        $persisted->qr_code = $fileName;
                        $persisted->save();
                    }
                }
            },
        ];
    }
}
