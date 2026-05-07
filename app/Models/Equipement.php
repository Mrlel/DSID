<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'des_equipement',
        'marque',
        'modele',
        'categorie',
        'nature',
        'num_inventaire',
        'adresse_mac',
        'numero_serie', 
        'date_acquis',
        'capacite',
        'ram',
        'source_acquisition', 
        'nom_fn',
        'processeur',
        'systeme',
        'etat',
        'statut',
        'qr_code',
        'user_id',
        'direction_id',
        'etat',
        'poste_id', // Ajout de la relation avec le poste
    ];
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($equipement) {
            if (empty($equipement->num_inventaire)) {
                $equipement->num_inventaire = self::generateAutoNumInventaire($equipement->direction_id);
            }
        });
    }

    public static function generateAutoNumInventaire($directionId)
    {
        $direction = Direction::find($directionId);
        $directionCode = $direction ? strtoupper(substr($direction->name, 0, 3)) : 'DIR';

        $lastEquipement = self::where('direction_id', $directionId)
            ->where('num_inventaire', 'LIKE', $directionCode . '-%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastEquipement && preg_match('/-(\d{4})$/', $lastEquipement->num_inventaire, $matches)) {
            $lastNumber = (int)$matches[1];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad( 'EQP' . $nextNumber, 4, '0', STR_PAD_LEFT);
        return $directionCode . '-' . $formattedNumber;
    }

public function scopeAvailable($query)
{
    return $query->where('statut', 'en stock')
                ->whereNull('poste_id');
}

 public function poste()
    {
        return $this->belongsTo(Poste::class);
    }
public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

    public function licences()
    {
        return $this->hasMany(Licence::class);
    }
    public function logicielsAssignes()
{
    return $this->hasMany(AssignerLogiciel::class);
}
    public function maintenances()
{
    return $this->hasMany(Maintenance::class);
}

public function equipements()
{
    return $this->hasMany(Equipement::class, 'user_id');
}
public function assignments()
{
    return $this->hasMany(Assignment::class);
}

// Pour obtenir l'utilisateur actuel (si un seul à la fois)
public function utilisateurActuel()
{
    return $this->belongsToMany(User::class, 'assignments')
                ->withPivot('assigned_at', 'returned_at')
                ->wherePivot('returned_at', null);
}

public function direction()
{
    return $this->belongsTo(Direction::class);
}

public function documents()
{
    return $this->hasMany(Documents::class);
}
public function contrat_garanties()
{
    return $this->hasMany(Contrat_garantie::class);
}
public function alertes()
{
    return $this->hasMany(Alertes::class); 
}
public function journal_modifs()
{
    return $this->hasMany(Journal_modif::class);
}
public function demande_maintenance()
{
    return $this->hasMany(DemandeMaintenance::class);
}

}