<?php

namespace App\Http\Controllers;
use App\Models\Licence;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatistiqueController extends Controller{

    public function show_Gestion_stock(){
        $now = Carbon::now();
        $limitDate = $now->copy()->addDays(10);
        $assignments = Assignment::with(['user', 'equipement'])->get();
        $equipementsEnStock = Equipement::where('etat', 'en stock')
        ->get();
        $equipementsEnService = Equipement::where('etat', 'en service')
        ->has('assignments')
        ->get();
        $licencesExpirees = Licence::where('date_expiration', '<', $now)->get();
        $licencesBientotExpirees = Licence::whereBetween('date_expiration', [$now, $limitDate])->get();
        $licences = Licence::where('date_expiration', '>', $limitDate)->paginate(100);

        $users_equipes = User::whereHas('assignments', function ($query) {
            $query->whereNull('returned_at');
        })->get();
        $users_non_equipes = User::whereDoesntHave('assignments', function ($query) {
            $query->whereNull('returned_at');
        })->get();
        return view('Admin.Gestion-stock'
        , compact(
        'assignments', 
        'equipementsEnStock', 
        'equipementsEnService', 
        'licencesExpirees', 
        'licencesBientotExpirees', 
        'licences',
        'users_equipes',
        'users_non_equipes'
        ));
    }

    public function getEquipementStats()
    {
        $stats = DB::table('equipements')
            ->select('etat', DB::raw('count(*) as total'))
            ->groupBy('etat')
            ->get();

        return response()->json($stats);
    }

    public function getMaintenanceStats()
    {
        $stats = DB::table('maintenances')
            ->select('statut_maintenance', DB::raw('count(*) as total'))
            ->groupBy('statut_maintenance')
            ->get();

        return response()->json($stats);
    }

    public function getUserAssignments($userId)
    {
        $assignments = DB::table('assignments')
            ->join('equipements', 'assignments.equipement_id', '=', 'equipements.id')
            ->where('assignments.user_id', $userId)
            ->select('equipements.des_equipement', 'assignments.assigned_at', 'assignments.returned_at')
            ->get();

        return response()->json($assignments);
    }

    public function chatbot(Request $request)
    {
        $message = $request->input('message');
        $response = '';

        // Exemple de logique pour analyser le message
        if (str_contains(strtolower($message), 'equipement en stock')) {
            $count = Equipement::where('etat', 'en stock')->count();
            $response = "Il y a actuellement $count équipements en stock.";
        } elseif (str_contains(strtolower($message), 'licences expirées')) {
            $count = Licence::where('date_expiration', '<', Carbon::now())->count();
            $response = "Il y a $count licences expirées.";
        } else {
            $response = "Désolé, je ne comprends pas votre demande.";
        }

        return response()->json(['response' => $response]);
    }
}