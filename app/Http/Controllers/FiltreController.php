<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Direction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EquipementsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;


class FiltreController extends Controller
{
    public function index(Request $request)
    {

            $user = auth()->user();
            $directionId = $user->direction_id ?? null;

        $query = Equipement::where('direction_id', $directionId)->with(['direction', 'user'])
            ->orderBy('created_at', 'desc');

        // Filtres
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }
        
        if ($request->filled('nature')) {
            $query->where('nature', $request->nature);
        }
        
        if ($request->filled('etat')) {
            $query->where('etat', $request->etat);
        }
        
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
       if ($request->filled('poste_id')) {
            $query->where('poste_id', $request->poste_id);
        }
        
        $directionLogo = auth()->user()->direction->logo;
        $directionLogoPath = $directionLogo 
            ? storage_path('public/' . $directionLogo) 
            : public_path('default-direction-logo.png');
    
        $equipements = $query->get();

        return view('materiels.inventaire', compact('equipements','directionLogoPath'));
    }

public function export(Request $request)
{
    $format = $request->format;
    $fields = $request->fields ?? [];

    if (empty($fields)) {
        return back()->with('error', 'Veuillez sélectionner au moins un champ à exporter');
    }

    $query = Equipement::query();
    // Restreindre aux équipements de la direction de l'utilisateur connecté
    $query->where('direction_id', auth()->user()->direction_id);
    if ($request->filled('categorie')) $query->where('categorie', $request->categorie);
    if ($request->filled('nature')) $query->where('nature', $request->nature);
    if ($request->filled('etat')) $query->where('etat', $request->etat);
    if ($request->filled('statut')) $query->where('statut', $request->statut);
    // On ignore le filtre direction_id pour éviter d'exporter d'autres directions

    $equipements = $query->get();

    $direction = auth()->user()->direction;
    $directionLogo = $direction->logo ?? null;
    
    // Pour le PDF, on utilise le chemin du stockage public
    $directionLogoPath = $directionLogo 
        ? public_path('storage/' . $directionLogo) 
        : public_path('default-direction-logo.png');

    if ($format === 'pdf') {
        $directionName = $direction->nom_direction ?? null;
        // Convertir l'image en base64 pour l'affichage dans le PDF
        $logoContent = file_get_contents($directionLogoPath);
        $logoBase64 = 'data:image/' . pathinfo($directionLogoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($logoContent);
        $pdf = \PDF::loadView('pdf.fiche_inventaire', [
            'equipements' => $equipements,
            'fields' => $fields,
            'direction' => $directionName,
            'directionLogoPath' => $logoBase64,
        ])->setPaper('a4', 'landscape');
        return $pdf->download('fiche-inventaire-'.date('Y-m-d').'.pdf');
    }
    $fileName = 'inventaire-equipements-' . date('Y-m-d') . '.' . $format;
    return \Excel::download(new \App\Exports\EquipementsExport($request->all(), $fields,$directionLogoPath), $fileName);
}

}
