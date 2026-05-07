<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Equipement;
use App\Models\Administrateur;
use App\Models\DemandeMaintenance;
use App\Models\DemandeMateriel;
use App\Models\Licence;
use App\Models\Assignment;
use Carbon\Carbon;
use PDF;

class DashboardController extends Controller
{
    public function showWelcome()
    {
        return view('welcome');
    }
    /*public function showdashboard()
    {
        $Users = User::all();
        $materielsEnStock= Equipement::where('etat', 'en stock')->get();
        $materielsHorsService = Equipement::where('etat', 'hors service')->get();
        $materielsEnMaintenance = Equipement::where('etat', 'en maintenance')->get();
        $materielsEnService = Equipement::where('etat', 'en service')->get();
        $nombreDeployes = Assignment::where('returned_at', null)->count();
        $materielsNonAttribues = Equipement::whereDoesntHave('assignments')->get();
        return view('Admin.dashboard',compact('Users','materielsEnStock','materielsHorsService','materielsEnMaintenance','materielsEnService','nombreDeployes','materielsNonAttribues'));
    }*/
    public function showAdmin_dashboard()
    {
        $demandes_maintenance = DemandeMaintenance::where('direction_id', auth()->user()->direction_id)->get();
        $Users = User::where('direction_id', auth()->user()->direction_id)
        ->where('role', '!=', 'superadmin')
        ->get();
        $equipements = Equipement::where('direction_id', auth()->user()->direction_id)->get();
        $demandes = DemandeMateriel::where('direction_id', auth()->user()->direction_id)->get();
        $logiciels = Licence::where('direction_id', auth()->user()->direction_id)->get();
        $attributions = Assignment::where('direction_id', auth()->user()->direction_id)->get();
        $now = Carbon::now();
        $limitDate = $now->copy()->addDays(10);
        $assignments = Assignment::where('direction_id', auth()->user()->direction_id)->with(['user', 'equipement'])->get();
        $equipementsEnStock = Equipement::where('statut', 'en stock')
        ->where('direction_id', auth()->user()->direction_id)
        ->get();
        $equipementsEnService = Equipement::where('statut', 'en service')
        ->where('direction_id', auth()->user()->direction_id)
        /*->has('assignments')*/
        ->get();
        $equipementsEnMaintenance = Equipement::where('statut', 'en maintenance')
        ->where('direction_id', auth()->user()->direction_id)
        ->get();
        $equipementsHorsService = Equipement::where('etat', 'hors service')
        ->where('direction_id', auth()->user()->direction_id)
        ->get();
        $licencesExpirees = Licence::where('direction_id', auth()->user()->direction_id)->where('date_expiration', '<', $now)->get();
        $licencesBientotExpirees = Licence::where('direction_id', auth()->user()->direction_id)->whereBetween('date_expiration', [$now, $limitDate])->get();
        $licences = Licence::where('direction_id', auth()->user()->direction_id)->where('date_expiration', '>', $limitDate)->paginate(100);

        $ordinateurs_portables = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Ordinateur portable')->get();
        $ordinateurs_allinone = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Ordinateur All-in-one')->get();
        $unites_centrales = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'unite centrale')->get();
        $outillages_techniques = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'outillage technique')->get();
        $imprimantes = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Imprimante')->get();
        $ecrans = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'ecran')->get();
        $claviers = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'clavier')->get();
        $souris = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'souris')->get();
        $scanners = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Scanner')->get();
        $serveurs = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Serveur')->get();
        $routeurs = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Routeur')->get();
        $switchs = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Switch')->get();
        $onduleurs = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Onduleur')->get();
        $projecteurs = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Projecteur')->get();
        $telephones_ip = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Téléphone IP')->get();
        $parefeux = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'pare-feu')->get();
        $photocopieuses = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'photocopieuse')->get();
        $stockages = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'stockage')->get();
        $visio = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'systeme visio conference')->get();
        $accessoires_electriques = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Accessoire electrique')->get();
        $accessoires_reseau = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Accessoire reseau')->get();
        $accessoires_securite = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Accessoire securite')->get();
        $autres = Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Autre')->get();

        
        // Données pour les graphiques
        $chartData = [
            // Graphique des licences
            'licences' => [
                'labels' => ['Licences expirées', 'Licences bientôt expirées', 'Licences actives'],
                'values' => [
                    $licencesExpirees->count(),
                    $licencesBientotExpirees->count(),
                    $licences->count()
                ]
            ],
            // Graphique des équipements
            'equipements' => [
                'labels' => ['En stock', 'En service', 'En maintenance'],
                'values' => [
                    $equipementsEnStock->count(),
                    $equipementsEnService->count(),
                    $equipementsEnMaintenance->count(),
                ]
            ],
            // Graphique des demandes de maintenance
            'demandes' => [
                'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                'values' => array_map(function($month) {
                    $startOfMonth = Carbon::now()->startOfYear()->startOfMonth()->addMonth($month - 1);
                    $endOfMonth = $startOfMonth->copy()->endOfMonth();
                    return DemandeMaintenance::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->count();
                }, range(1, 12))
            ]
        ];


        $users_equipes = User::where('direction_id', auth()->user()->direction_id)->whereHas('assignments', function ($query) {
            $query->whereNull('returned_at');
        })->get();
        $users_non_equipes = User::where('direction_id', auth()->user()->direction_id)->whereDoesntHave('assignments', function ($query) {
            $query->whereNull('returned_at');
        })->get();
        return view('Directeur.dashboard',compact(
            'demandes_maintenance',
        'Users',
        'equipements',
        'demandes',
        'licences',
        'logiciels',
        'attributions',
        'assignments',
        'equipementsEnStock',
        'equipementsEnService',
        'equipementsEnMaintenance',
        'equipementsHorsService',
        'licencesExpirees',
        'licencesBientotExpirees',
        'licences',
        'users_equipes',
        'users_non_equipes',
        'chartData',
        'ordinateurs_portables',
        'ordinateurs_allinone',
        'unites_centrales',
        'outillages_techniques',
        'imprimantes',
        'ecrans',
        'claviers',
        'souris',
        'scanners',
        'serveurs',
        'routeurs',
        'switchs',
        'onduleurs',
        'projecteurs',
        'telephones_ip',
        'accessoires_electriques',
        'parefeux',
        'photocopieuses',
        'stockages',
        'visio',
        'accessoires_reseau',
        'accessoires_securite',
        'autres'
        
));
    }
    public function exportDashboardPdf()
    {
        $now = Carbon::now();
        $limitDate = $now->copy()->addDays(10);
        
        $data = [
            'equipementsEnStock' => Equipement::where('statut', 'en stock')
                ->where('direction_id', auth()->user()->direction_id)
                ->count(),
                
            'equipementsEnService' => Equipement::where('statut', 'en service')
                ->where('direction_id', auth()->user()->direction_id)
                ->has('assignments')
                ->count(),
                
            'equipementsEnMaintenance' => Equipement::where('statut', 'en maintenance')
                ->where('direction_id', auth()->user()->direction_id)
                ->has('assignments')
                ->count(),
                
            'equipementsHorsService' => Equipement::where('etat', 'hors service')
                ->where('direction_id', auth()->user()->direction_id)
                ->count(),
                
            'licencesExpirees' => Licence::where('direction_id', auth()->user()->direction_id)
                ->where('date_expiration', '<', $now)
                ->count(),
                
            'licencesBientotExpirees' => Licence::where('direction_id', auth()->user()->direction_id)
                ->whereBetween('date_expiration', [$now, $limitDate])
                ->count(),
                
            'licencesActives' => Licence::where('direction_id', auth()->user()->direction_id)
                ->where('date_expiration', '>', $limitDate)
                ->count(),
                
            'usersEquipes' => User::where('direction_id', auth()->user()->direction_id)
                ->whereHas('assignments', function ($query) {
                    $query->whereNull('returned_at');
                })->count(),
                
            'usersNonEquipes' => User::where('direction_id', auth()->user()->direction_id)
                ->whereDoesntHave('assignments', function ($query) {
                    $query->whereNull('returned_at');
                })->count(),
                
            'statsEquipements' => [
                'ordinateurs portable' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Ordinateur portable')->count(),
                'ordinateurs all-in-one' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Ordinateur All-in-one')->count(),
                'unite centrale' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'unite centrale')->count(),
                'outillage technique' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'outillage technique')->count(),
                'imprimantes' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'imprimante')->count(),
                'souris' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'souris')->count(),
                'clavier' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'clavier')->count(),
                'ecran' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'ecran')->count(),
                'scanners' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'scanner')->count(),
                'serveurs' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'serveur')->count(),
                'routeurs' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'routeur')->count(),
                'switchs' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'switch')->count(),
                'onduleurs' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'onduleur')->count(),
                'projecteurs' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'projecteur')->count(),
                'telephones_ip' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'téléphone IP')->count(),
                'pare-feu' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'pare-feu')->count(),
                'photocopieuse' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'photocopieuse')->count(),
                'stockage' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'stockage')->count(),
                'systeme visio conference' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'systeme visio conference')->count(),
                'Accessoire electrique' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Accessoire electrique')->count(),
                'Accessoire reseau' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Accessoire reseau')->count(),
                'Accessoire securite' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'Accessoire securite')->count(),
                'autres' => Equipement::where('direction_id', auth()->user()->direction_id)->where('categorie', 'autre')->count(),
            ],
            'dateGeneration' => $now->format('d/m/Y H:i')
        ];

        $pdf = PDF::loadView('pdf.dashboard', $data);
        return $pdf->download('tableau-de-bord-'.now()->format('Y-m-d').'.pdf');
    }
}
