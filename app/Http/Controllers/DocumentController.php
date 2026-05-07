<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsModifications;

class DocumentController extends Controller
{
    use LogsModifications;
    
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'type_document' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'equipement_id' => 'required|exists:equipements,id',
            'document' => 'required|file|max:10240', // Max 10MB
        ]);

        $path = $request->file('document')->store('documents');

        $document = Documents::create([
            'titre' => $request->titre,
            'chemin_document' => $path,
            'type_document' => $request->type_document,
            'description' => $request->description,
            'equipement_id' => $request->equipement_id,
            'user_id' => auth()->id(),
            'direction_id' => auth()->user()->direction_id
        ]);

        $this->logModification(
            'ajouter',
            "Ajout d'un document",
            $document->id
        );

        return redirect()->back()
            ->with('success', 'Document ajouté avec succès');
    }

    public function destroy(Documents $document)
    {
        Storage::delete($document->chemin_document);
        $document->delete();

        $this->logModification(
            'supprimer',
            "Suppression d'un document",
            $document->id
        );

        return redirect()->back()
            ->with('success', 'Document supprimé avec succès');
    }
}