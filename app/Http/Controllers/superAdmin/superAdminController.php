<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Equipement;
use App\Models\User;
use App\Models\DemandeMaintenance;
use App\Models\Assignment;
use App\Models\AssignerController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use carbon\Carbon;
use App\Traits\LogsModifications;

class superAdminController extends Controller
{
    use LogsModifications;
    public function listAdmins()
    {
        Carbon::setLocale('fr');
        $dateToday = Carbon::now();
        $directions = Direction::all();
        $admins = User::all();
        $admininistrateurs = User::where('role', 'admin')
        ->get();
        return view('SuperAdmin.Administrateurs.list-admin', compact('directions', 'admins', 'dateToday', 'admininistrateurs'));
    }
    public function createAdmin()
    {
        Carbon::setLocale('fr');
        $dateToday = Carbon::now();
        $directions = Direction::all();
        return view('SuperAdmin.Administrateurs.create', compact('dateToday', 'directions'));
    }
    
    public function storeAdmin(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'matricule' => 'required|string|unique:users,matricule',
        'email' => 'required|string|email|unique:users,email',
        'contact' => 'required|string',
        'emploie' => 'required|string',
        'fonction' => 'required|string',
        'grade' => 'required|string',
        'role' => 'nullable',
        'direction_id' => 'required|exists:directions,id' // Vérifie aussi que la direction existe
    ]);

    User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'matricule' => $request->matricule,
        'email' => $request->email,
        'contact' => $request->contact,
        'emploie' => $request->emploie,
        'fonction' => $request->fonction,
        'grade' => $request->grade,
        'role' => $request->role ?? 'user',
        'password' => Hash::make('12345678'),
        'direction_id' => $request->direction_id
    ]);

    return redirect()->route('directions.list-admin')->with('success', 'Administrateur créé avec succès.');
}


    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        $directions = Direction::all();
        $dateToday = Carbon::now();
        return view('SuperAdmin.Administrateurs.edit', compact('admin', 'directions', 'dateToday'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'matricule' => 'required|string|unique:users,matricule,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
            'contact' => 'required|string',
            'emploie' => 'required|string',
            'fonction' => 'required|string',
            'grade' => 'required|string',
            'role' => 'nullable',
            'direction_id' => 'required'
        ]);
        
        $admin = User::findOrFail($id);
        $admin->update($request->all());
        
        return redirect()->route('directions.list-admin')->with('success', 'Administrateur modifié avec succès.');
    }

    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);
        if($admin->role === 'superadmin'){
            return redirect()->back()->with('error', 'Impossible de supprimer un super admin.');
        }
        $admin->delete();
        return redirect()->back()->with('success', 'Administrateur supprimé avec succès.');
    }

    public function showAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('SuperAdmin.Administrateurs.show', compact('admin'));
    }




    public function updatePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->old_password, $user->password)) {
        return back()->with('error', 'Ancien mot de passe incorrect.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Mot de passe mis à jour avec succès.');
}



    public function updatePasswordAdmin($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.update-password-admin', compact('user'));
    }


public function resetPassword($id)
{
    $user = User::findOrFail($id);

    // Optionnel : Vérifie que ce n'est pas un super admin lui-même
    if ($user->role === 'superadmin') {
        return back()->with('error', 'Impossible de réinitialiser ce mot de passe.');
    }

    $user->password = Hash::make('Dsid@2025');
    $user->password_changed_at = null;
    $user->save();
    $this->logModification(
        'reset-password',
        "Réinitialisation du mot de passe de l'utilisateur {$user->nom} {$user->prenom}",
        null
    );

    return redirect()->back()->with('success', 'Mot de passe réinitialisé avec succès.');
}

}


