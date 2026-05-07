<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Equipement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Licence;
use App\Models\Assignment;
use App\Models\eqp_Type;
use App\Models\Type_logiciel;
use App\Models\SourceAcquisition;
use App\Models\eqp_Categorie;
use App\Models\Poste;
use App\Traits\LogsModifications;

class MaterielController extends Controller
{
    use LogsModifications;

private function getEquipementsParStatut($Statut)
{
    $directionId = Auth::user()->direction_id;

    return Equipement::where('direction_id', $directionId)
                     ->where('statut', $Statut)
                     ->get();
}

private function getMaterielsGeneraux()
{
    $directionId = Auth::user()->direction_id;

    return [
        'users' => User::where('direction_id', $directionId)->get(),
        'licences' => Licence::where('direction_id', $directionId)->get(),
        'assignments' => Assignment::all(), // ici assignment doit être aussi filtré si nécessaire !
        'EquipementsAttribues' => Equipement::where('direction_id', $directionId)->has('assignments')->get(),
        'materielsNonAttribues' => Equipement::where('direction_id', $directionId)->doesntHave('assignments')->get(),
    ];
}

public function list_stock()
{
    $materiels = $this->getMaterielsGeneraux();
    $materiels['materielsEnStock'] = $this->getEquipementsParStatut('en stock');
    $materiels['materielsHorsService'] = $this->getEquipementsParStatut('hors service');
    $materiels['materielsEnMaintenance'] = $this->getEquipementsParStatut('en maintenance');
    $materiels['materielsEnService'] = $this->getEquipementsParStatut('en service');/*->filter(function ($equipement) {
        return $equipement->assignments->isNotEmpty();
    });*/
    $materiels['nombreDeployes'] = $materiels['materielsEnService']->count();

    $materiels['sources'] = SourceAcquisition::all();
$postes = Poste::with('equipements')->where('direction_id', Auth::user()->direction_id)->get();
    

    return view('Patrimoine.equipements.stock_materiel', $materiels, compact('postes'));
}

public function materielsEnService()
{
    $materiels = $this->getMaterielsGeneraux();
    $materiels['materielsEnStock'] = $this->getEquipementsParStatut('en stock');
    $materiels['materielsHorsService'] = $this->getEquipementsParStatut('hors service');
    $materiels['materielsEnMaintenance'] = $this->getEquipementsParStatut('en maintenance');
    $materiels['materielsEnService'] = $this->getEquipementsParStatut('en service');/*->filter(function ($equipement) {
        return $equipement->assignments->isNotEmpty();
    });*/
    $materiels['nombreDeployes'] = $materiels['materielsEnService']->count();
    $postes = Poste::with('equipements')->where('direction_id', Auth::user()->direction_id)->get();

    return view('Patrimoine.equipements.materiels-en-service', $materiels, compact('postes'));
}

public function materielsEnMaintenance()
{
    $materiels = $this->getMaterielsGeneraux();
    $materiels['materielsEnStock'] = $this->getEquipementsParStatut('en stock');
    $materiels['materielsHorsService'] = $this->getEquipementsParStatut('hors service');
    $materiels['materielsEnMaintenance'] = $this->getEquipementsParStatut('en maintenance');
    $materiels['materielsEnService'] = $this->getEquipementsParStatut('en service');/*->filter(function ($equipement) {
        return $equipement->assignments->isNotEmpty();
    });*/
    $materiels['nombreDeployes'] = $materiels['materielsEnService']->count();
    $postes = Poste::with('equipements')->where('direction_id', Auth::user()->direction_id)->get();

    return view('Patrimoine.equipements.materiels-en-maintenance', $materiels, compact('postes'));
}
/*
public function recherche(Request $request)
{
    $directionId = Auth::user()->direction_id;
    $query = $request->input('q');

    $equipements = Equipement::where('direction_id', $directionId)
        ->where(function($q) use ($query) {
            $q->where('des_equipement', 'like', "%$query%")
              ->orWhere('marque', 'like', "%$query%")
              ->orWhere('modele', 'like', "%$query%")
              ->orWhere('categorie', 'like', "%$query%")
              ->orWhere('num_inventaire', 'like', "%$query%");
        })
        ->get();

    // Passe les résultats à la vue (adapte selon ta structure)
    return view('Materiels.stock_materiel', [
        'equipements' => $equipements,
        'q' => $query,
        // Ajoute ici les autres variables nécessaires à la vue
    ]);
}*/
}