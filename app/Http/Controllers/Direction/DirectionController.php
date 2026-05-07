<?php

namespace App\Http\Controllers\Direction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Licence;
use App\Models\DemandeMaintenance;
use App\Models\Assignment;
use App\Models\AssignerController;
use Illuminate\Support\Str;
use carbon\Carbon;
use PDF;

class DirectionController extends Controller
{

    /*public function rapportWord(Request $request)
    {
        Carbon::setLocale('fr');
        $dateToday = Carbon::now();
    
        // Modifier pour appeler la logique de génération des stats directement
        $now = Carbon::now();
        $limitDate = $now->copy()->addDays(10);
        
        $directions = Direction::all();
        $directionId = $request->input('direction_id');
        
        $filteredDirections = $directionId ? $directions->where('id', $directionId) : $directions;
        
        $stats = [];
        
        foreach ($filteredDirections as $direction) {
            $equipements = Equipement::where('direction_id', $direction->id);
            $users = User::where('direction_id', $direction->id);
            $usersEquipes = $users->whereHas('assignments', function($q) {
                $q->whereNull('returned_at');
            });
            $licences = Licence::where('direction_id', $direction->id);
    
            $stats[$direction->id] = [
                'direction' => $direction->nom_direction,
                'equipements' => [
                    'total' => $equipements->count(),
                    'en_stock' => $equipements->where('etat', 'en stock')->count(),
                    'en_service' => $equipements->where('etat', 'en service')->count(),
                    'en_maintenance' => $equipements->where('etat', 'en maintenance')->count(),
                    'hors_service' => $equipements->where('etat', 'hors service')->count(),
                ],
                'utilisateurs' => [
                    'total' => $users->count(),
                    'equipes' => $usersEquipes->count(),
                    'non_equipes' => $users->count() - $usersEquipes->count(),
                    'connectes' => $users->whereNotNull('password_changed_at')->count()
                ],
                'logiciels' => [
                    'total' => $licences->count(),
                    'actifs' => $licences->where('date_expiration', '>', $now)->count(),
                    'bientot_expires' => $licences->whereBetween('date_expiration', [$now, $limitDate])->count(),
                    'expires' => $licences->where('date_expiration', '<', $now)->count(),
                ],
            ];
        }
        
        $pdf = Word::loadView('SuperAdmin.rapportWord', compact('stats', 'dateToday'));
        return $word->download('rapport.word');
    }*/
    
   public function rapportPDF(Request $request, $directionId = null)
   {
       Carbon::setLocale('fr');
       $dateToday = Carbon::now();
       $now = Carbon::now();
       $limitDate = $now->copy()->addDays(10);
       
       // Récupérer les directions en fonction des filtres
       $query = Direction::query();
       
       if ($directionId) {
           $query->where('id', $directionId);
       } elseif ($request->has('direction_id')) {
           $query->where('id', $request->input('direction_id'));
       }
       
       $filteredDirections = $query->get();
       
       if ($filteredDirections->isEmpty()) {
           return redirect()->back()->with('error', 'Aucune direction trouvée.');
       }
       
       $stats = [];
       
       foreach ($filteredDirections as $direction) {
           $equipements = Equipement::where('direction_id', $direction->id);
           $users = User::where('direction_id', $direction->id);
           $usersEquipes = $users->whereHas('assignments', function($q) {
               $q->whereNull('returned_at');
           });
           $licences = Licence::where('direction_id', $direction->id);
   
           $stats[$direction->id] = [
               'direction' => $direction->nom_direction,
               'equipements' => [
                   'total' => $equipements->count(),
                   'en_stock' => $equipements->clone()->where('etat', 'en stock')->count(),
                   'en_service' => $equipements->clone()->where('etat', 'en service')->count(),
                   'en_maintenance' => $equipements->clone()->where('etat', 'en maintenance')->count(),
                   'hors_service' => $equipements->clone()->where('etat', 'hors service')->count(),
               ],
               'utilisateurs' => [
                   'total' => $users->count(),
                   'equipes' => $usersEquipes->count(),
                   'non_equipes' => $users->count() - $usersEquipes->count(),
                   'connectes' => $users->clone()->whereNotNull('password_changed_at')->count()
               ],
               'logiciels' => [
                   'total' => $licences->count(),
                   'actifs' => $licences->clone()->where('date_expiration', '>', $now)->count(),
                   'bientot_expires' => $licences->clone()->whereBetween('date_expiration', [$now, $limitDate])->count(),
                   'expires' => $licences->clone()->where('date_expiration', '<', $now)->count(),
               ],
           ];
       }
       
       // Chemins absolus pour les images
       $logoGpi = public_path('logo-gpi.png');
       $logoDsid = public_path('dsid.jpg');
       
       // Récupérer la première direction pour le logo
       $direction = $filteredDirections->first();
       $directionLogoPath = $direction && $direction->logo 
           ? storage_path('app/public/' . $direction->logo) 
           : public_path('default-direction-logo.png');
       
       $pdf = PDF::loadView('SuperAdmin.rapportPDF', compact(
           'stats', 
           'dateToday', 
           'logoGpi', 
           'logoDsid', 
           'direction', 
           'directionLogoPath'
       ));
       
       return $pdf->download('rapport_direction.pdf');
   }

 public function rapport(Request $request)
{
    Carbon::setLocale('fr');
    $dateToday = Carbon::now();

    if (auth()->user()->role !== 'superadmin') {
        abort(403, 'Accès non autorisé');
    }

    $now = Carbon::now();
    $limitDate = $now->copy()->addDays(10);

    $directions = Direction::all();
    $directionId = $request->input('direction_id');

    $filteredDirections = $directionId ? $directions->where('id', $directionId) : $directions;

    $stats = [];

    foreach ($filteredDirections as $direction) {
        $equipementsBase = Equipement::where('direction_id', $direction->id);
        $users = User::where('direction_id', $direction->id);
        $usersCount = $users->count();
        $licences = Licence::where('direction_id', $direction->id);

        $stats[$direction->id] = [
            'direction' => $direction->nom_direction,
            'equipements' => [
                'total' => $equipementsBase->count(),
                'en_stock' => (clone $equipementsBase)->where('etat', 'en stock')->count(),
                'en_service' => (clone $equipementsBase)->where('etat', 'en service')->count(),
                'en_maintenance' => (clone $equipementsBase)->where('etat', 'en maintenance')->count(),
                'hors_service' => (clone $equipementsBase)->where('etat', 'hors service')->count(),
            ],
            'utilisateurs' => [
                'total' => $usersCount,
                'equipes' => $users->whereHas('assignments', function($q) {
                    $q->whereNull('returned_at');
                })->count(),
                'non_equipes' => $usersCount - $users->whereHas('assignments', function($q) {
                    $q->whereNull('returned_at');
                })->count(),
                'connectes' => $users->whereNotNull('password_changed_at')->count()
            ],
            'logiciels' => [
                'total' => $licences->count(),
                'actifs' => $licences->where('date_expiration', '>', $now)->count(),
                'bientot_expires' => $licences->whereBetween('date_expiration', [$now, $limitDate])->count(),
                'expires' => $licences->where('date_expiration', '<', $now)->count(),
            ],
        ];
    }

    return view('SuperAdmin.rapport', compact('stats', 'dateToday', 'directions'));
}


    


    public function superadminDashboard()
    {
        Carbon::setLocale('fr');
        $dateToday = Carbon::now();
        $directions = Direction::all();
        $directionsActives = Direction::where('statut', 'active')->count();
        $directionsInactives = Direction::where('statut', 'inactive')->count();
        $adminCount = User::where('role', 'admin')->count();

  
    // Vérification des droits (adaptez selon votre système)
    if (auth()->user()->role !== 'superadmin') {
        abort(403, 'Accès non autorisé');
    }

    // Date actuelle pour les calculs d'expiration
    $now = Carbon::now();
    $limitDate = $now->copy()->addDays(10);

    // Récupérer toutes les directions
    $directions = Direction::all();

    // Préparer les données statistiques
    $stats = [];
    
    foreach ($directions as $direction) {
        // Statistiques des équipements
        $equipements = Equipement::where('direction_id', $direction->id);
        
        // Statistiques des utilisateurs
        $users = User::where('direction_id', $direction->id);
        $usersEquipes = $users->whereHas('assignments', function($q) {
            $q->whereNull('returned_at');
        });
        
        // Statistiques des licences
        $licences = Licence::where('direction_id', $direction->id);
        
        $stats[$direction->id] = [
            'direction' => $direction->nom_direction,
            
            // Équipements
            'equipements' => [
                'total' => $equipements->count(),
                'en_stock' => $equipements->where('etat', 'en stock')->count(),
                'en_service' => $equipements->where('etat', 'en service')->count(),
                'en_maintenance' => $equipements->where('etat', 'en maintenance')->count(),
                'hors_service' => $equipements->where('etat', 'hors service')->count(),
            ],
            
            // Utilisateurs
            'utilisateurs' => [
                'total' => $users->count(),
                'equipes' => $usersEquipes->count(),
                'non_equipes' => $users->count() - $usersEquipes->count(),
                'connectes' => $users->whereNotNull('password_changed_at')->count()
            ],
            
            // Logiciels
            'logiciels' => [
                'total' => $licences->count(),
                'actifs' => $licences->where('date_expiration', '>', $now)->count(),
                'bientot_expires' => $licences->whereBetween('date_expiration', [$now, $limitDate])->count(),
                'expires' => $licences->where('date_expiration', '<', $now)->count(),
            ],
        ];
    }


        return view('SuperAdmin.dashboard', compact('directions', 'directionsActives', 'directionsInactives', 'dateToday', 'adminCount', 'stats'));
    }

    public function listDirections()
    {
        Carbon::setLocale('fr');
        $dateToday = Carbon::now();
        $directions = Direction::all();
        $directionsActives = Direction::where('statut', 'active')->count();
        $directionsInactives = Direction::where('statut', 'inactive')->count();
        $directionsAdministrés = Direction::whereHas('admin')->count();
        $admins = User::where('role', 'admin')
        /*->whereNull('direction_id')*/
        ->get();
        return view('SuperAdmin.Directions.list-direction', compact('directions', 'directionsActives', 'directionsInactives', 'dateToday', 'directionsAdministrés', 'admins'));
    }


    // Formulaire de création
    public function create()
    {
        Carbon::setLocale('fr');
        $dateToday = Carbon::now();
        return view('superAdmin.directions.create', compact('dateToday'));
    }

    // Enregistrer une direction
    public function store(Request $request)
    {
        $request->validate([
            'nom_direction' => 'required|unique:directions',
            'code_direction' => 'required|unique:directions',
            'type' => 'nullable|in:centrale,déconcentrée,partenaire',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'web_url' => 'nullable|url'
        ]);

        Direction::create([
            'nom_direction' => $request->nom_direction,
            'slug' => Str::slug($request->nom_direction),
            'code_direction' => $request->code_direction,
            'email_contact' => $request->email_contact,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'responsable' => $request->responsable,
            'statut' => $request->statut ?? 'active',
            'type' => $request->type,
            'logo' => $request->logo ? $request->logo->store('logos', 'public') : null,
            'web_url' => $request->web_url,
            'admin_id' => $request->admin_id,
        ]);

        return redirect()->route('directions.list-direction')->with('success', 'Direction créée avec succès.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nom_direction' => 'required|unique:directions,nom_direction,' . $id,
        'code_direction' => 'required|unique:directions,code_direction,' . $id,
        'type' => 'nullable|in:centrale,déconcentrée,partenaire',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'theme_color' => 'nullable|regex:/^#[a-f0-9]{6}$/i',
        'web_url' => 'nullable|url'
    ]);

    $direction = Direction::findOrFail($id);
    
    // Gestion du logo
    if ($request->hasFile('logo')) {
        $logoPath = $request->logo->store('logos', 'public');
        $direction->logo = $logoPath;
    }

    $direction->update([
        'nom_direction' => $request->nom_direction,
        'slug' => Str::slug($request->nom_direction),
        'code_direction' => $request->code_direction,
        'email_contact' => $request->email_contact,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'responsable' => $request->responsable,
        'statut' => $request->statut,
        'type' => $request->type,
        'theme_color' => $request->theme_color,
        'web_url' => $request->web_url,
        'admin_id' => $request->admin_id,
    ]);

    return redirect()->route('directions.list-direction')->with('success', 'Direction mise à jour avec succès.');
}

public function assignAdmin($id)
    {
        $direction = Direction::findOrFail($id);
        $admins = User::where('role', 'admin')
                  ->whereNull('direction_id')
                  ->get();
    return view('SuperAdmin.Directions.assign-admin', compact('direction', 'admins'));
}

public function storeAssignAdmin(Request $request, $id)
{
    $request->validate([
        'admin_id' => 'required|exists:users,id'
    ]);

    $direction = Direction::findOrFail($id);
    $admin = User::findOrFail($request->admin_id);
    if($admin->direction_id != null){
        return back()->with('error', 'Ce Administrateur déjà assigné à une direction.');
    }
    // Mettre à jour l'administrateur avec l'ID de la direction
    $admin->direction_id = $direction->id;
    $admin->save();
    
    // Mettre à jour la direction avec l'ID de l'administrateur
    $direction->admin_id = $admin->id;
    $direction->save();

    return back()->with('success', 'Administrateur assigné avec succès.');
}








    // Formulaire de modification
    public function edit($id)
    {
        $direction = Direction::findOrFail($id); // On récupère la direction par ID
        $users = User::all(); // On récupère tous les utilisateurs (tu peux filtrer si besoin)
        $dateToday = Carbon::now();
        $admins = User::where('role', 'admin')
            ->whereNull('direction_id')
            ->get();
        return view('superAdmin.Directions.edit', compact('direction', 'users', 'dateToday', 'admins'));
    }

    // Mise à jour
   



    // Supprimer une direction
    public function destroy($id)
    {
        $direction = Direction::findOrFail($id);
        $direction->delete();
        return back()->with('success', 'Direction supprimée.');
    }
}
