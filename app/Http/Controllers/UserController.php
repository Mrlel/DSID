<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Licence;
use App\Models\Fonction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UserImport;
use App\Traits\LogsModifications;


class UserController extends Controller
{
    use LogsModifications;
  
public function showUserlist()
{
    $userStats = $this->getUserStats();

    $statistiques = Equipement::all();
    $licences = Licence::all();

    $fonctions = Fonction::where('direction_id', Auth::user()->direction_id)->get();
    $informaticiens = User::whereHas('fonction', function ($q) {
        $q->where('fonction', 'informaticien');
    })->get();

    return view('Admin.tableau_utilisateurs', compact(
        'statistiques',
        'licences',
        'fonctions',
        'informaticiens'
    ) + $userStats);
}

    
    public function showUser_equipes()
    {
        $userStats = $this->getUserStats();
        $statistiques = Equipement::all();
        $licences = Licence::all();
        $fonctions = Fonction::where('direction_id', Auth::user()->direction_id)->get();
        $informaticiens = User::whereHas('fonction', function ($q) {
            $q->where('fonction', 'informaticien');
        })->get();

        return view('Admin.user_equipe', array_merge($userStats, compact('statistiques', 'licences', 'fonctions', 'informaticiens')));
    }
    
    public function showUser_non_equipes()
    {
        $userStats = $this->getUserStats();
        $statistiques = Equipement::all();
        $licences = Licence::all();
        $fonctions = Fonction::where('direction_id', Auth::user()->direction_id)->get();
        $informaticiens = User::whereHas('fonction', function ($q) {
            $q->where('fonction', 'informaticien');
        })->get();

        return view('Admin.user_non_equipe', array_merge($userStats, compact('statistiques', 'licences', 'fonctions', 'informaticiens')));
    }

  public function ExportUsers_listPdf(Request $request) {
    $users = $this->getUsersByRole()->get();

    $pdf = \PDF::loadView('Admin.export_users_list', compact('users'));
    $pdf->setPaper('A4', 'landscape'); 
    
    return $pdf->download('Admin.export_users_list.pdf');
}

    public function ExportUsers_listExcel(Request $request)
    {
        $users = $this->getUsersByRole()->get();
        return Excel::download(new UsersExport($users), 'users_list.xlsx');
    }
    
    public function importUsers(Request $request)
    {
        $request->validate([
            'fichier' => 'required|mimes:xlsx,xls'
        ]);

        $user = Auth::user();
        
        try {
            Excel::import(
                new UserImport($user->direction_id),
                $request->file('fichier')
            );

            $this->logModification(
                'import',
                "Importation d'utilisateurs",
                null
            );

            return redirect()->back()->with('success', 'Utilisateurs importés avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'import : ' . $e->getMessage());
        }
    }

    public function saveAdd_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'matricule' => 'required|string|unique:users,matricule',
            'email' => 'required|string|email|unique:users,email',
            'contact' => 'required|string',
            'emploie' => 'required|string',
            'fonction_id' => 'required|string',
            'grade' => 'required|string',
            'date_prise_service_un' => 'nullable|string',
            'date_prise_service' => 'nullable|string',
            'role' => 'required|in:user,chef_de_service,admin,sous_directeur,gestionnaire_parc,technicien',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            $admin = Auth::user();
    
            // Sécurité : vérifier que l'admin a bien une direction
            if (is_null($admin->direction_id)) {
                return redirect()->back()
                    ->with('error', 'Votre compte n\'est pas associé à une direction. Impossible de créer un utilisateur.')
                    ->withInput();
            }
    
            // Création de l'utilisateur dans la même direction que l'admin
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'matricule' => $request->matricule,
                'email' => $request->email,
                'contact' => $request->contact,
                'emploie' => $request->emploie,
                'fonction_id' => $request->fonction_id,
                'grade' => $request->grade,
                'date_prise_service_un' => $request->date_prise_service_un,
                'date_prise_service' => $request->date_prise_service,
                'role' => $request->role,
                'direction_id' => $admin->direction_id, 
                'password' => Hash::make('12345678'),
            ]);

            $this->logModification(
                'ajouter',
                "Ajout d'un utilisateur",
                $user->id
            );    
            return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage())
                ->withInput();
        }
    }
    

    public function userDelete($id)
    {
        $user = User::find($id);
        if($user->role === 'admin'){
            return redirect('/userlist')->with('error', 'Impossible de supprimer un admin.');
        }
        if (!$user) {
            return redirect('/userlist')->with('error', 'Utilisateur introuvable.');
        }
        
        $user->delete();
        $this->logModification(
            'supprimer',
            "Suppression d'un utilisateur",
            $user->id
        );
        return redirect('/userlist')->with('message', 'L\'utilisateur a bien été supprimé !');
    }

    private function getUsersByRole()
    {
        $currentUser = auth()->user();
    
        if ($currentUser->role === 'superadmin') {
            return User::query();
        } elseif ($currentUser->role === 'admin') {
            return User::where('direction_id', $currentUser->direction_id);
        } else {
            return User::where('id', $currentUser->id);
        }
    }
    public function search(Request $request)
{
    $q = $request->q;

    return User::where('nom', 'LIKE', "%$q%")
        ->orWhere('prenom', 'LIKE', "%$q%")
        ->orWhere('matricule', 'LIKE', "%$q%")
        ->limit(20)
        ->get();
}

private function getUserStats()
{
    $usersQuery = $this->getUsersByRole()
        ->where('role', '!=', 'superadmin'); 

    return [
        'users' => (clone $usersQuery)->get(),
        'login_users' => (clone $usersQuery)->whereNotNull('password_changed_at')->get(),
        'users_equipes' => (clone $usersQuery)->whereHas('assignments', function ($query) {
            $query->whereNull('returned_at');
        })->get(),
        'users_non_equipes' => (clone $usersQuery)->whereDoesntHave('assignments', function ($query) {
            $query->whereNull('returned_at');
        })->get(),
    ];
}
    
    public function showLoggedUsers()
    {
        $userStats = $this->getUserStats();
        $statistiques = Equipement::all();
        $licences = Licence::all();
    
        return view('Admin.user_connecter', array_merge($userStats, compact('statistiques', 'licences')));
    }
    
    

    public function showUpdateUserForm($id)
    {
        $users = User::find($id);
        $fonctions = Fonction::where('direction_id', Auth::user()->direction_id)->get();
        return view('Users.update_userList', compact('users','fonctions'));
    }

    public function save_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'matricule' => 'required|string|unique:users,matricule,' . $request->id,
            'email' => 'required|string|email|unique:users,email,' . $request->id,
            'contact' => 'required|string',
            'emploie' => 'required|string',
            'fonction_id' => 'required|string',
            'grade' => 'required|string',
            'date_prise_service_un' => 'nullable|string',
            'date_prise_service' => 'nullable|string',

            'role' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $users = User::find($request->id);
        if (!$users) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé');
        }

        $users->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'email' => $request->email,
            'contact' => $request->contact,
            'emploie' => $request->emploie,
            'fonction_id' => $request->fonction_id,
            'grade' => $request->grade,
            'date_prise_service_un' => $request->date_prise_service_un,
            'date_prise_service' => $request->date_prise_service,
            'role' => $request->role ?? 'user',
        ]);

        $this->logModification(
            'modification',
            "Modification d'un utilisateur",
            $request->id ?? null
        );
        return redirect('/userlist')->with('status', 'Utilisateur modifié avec succès !');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('Users.editProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'matricule' => 'nullable|string|unique:users,matricule,' . Auth::id(),
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|confirmed',
            'contact' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->matricule = $request->matricule;
        $user->email = $request->email;
        $user->contact = $request->contact;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $this->logModification(
            'modification',
            "Modification de votre profil",
            Auth::id()
        );

        return redirect()->back()->with('success', 'Profil mis à jour avec succès !');
    }

}

