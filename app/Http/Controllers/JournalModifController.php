<?php

namespace App\Http\Controllers;

use App\Models\Journal_modif;
use Illuminate\Http\Request;
use App\Models\User;

class JournalModifController extends Controller
{
    public function index(Request $request)
    {
        $query = Journal_modif::with(['equipement', 'user'])
            ->where('direction_id', auth()->user()->direction_id);

        // Filtre par date de début
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        // Filtre par date de fin
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }
        // Filtre par utilisateur
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        // Filtre par action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $modifications = $query->orderBy('created_at', 'desc')->get();
        $users = \App\Models\User::where('direction_id', auth()->user()->direction_id)->get();
        return view('Materiels.Journal.index', compact('modifications', 'users'));
    }

    public static function logModification($action, $description, $equipement_id)
    {
        Journal_modif::create([
            'action' => $action,
            'description' => $description,
            'equipement_id' => $equipement_id ?? null,
            'user_id' => auth()->id(),
            'direction_id' => auth()->user()->direction_id
        ]);
    }
}