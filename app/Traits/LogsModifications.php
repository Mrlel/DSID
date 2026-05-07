<?php

namespace App\Traits;

use App\Models\Journal_modif;

trait LogsModifications
{
 protected function logModification(string $action, string $description, $equipement_id = null)
{
    // Vérifier que l'équipement existe réellement
    if (!is_null($equipement_id) && !\App\Models\Equipement::where('id', $equipement_id)->exists()) {
        $equipement_id = null;
    }

    Journal_modif::create([
        'action' => $action,
        'description' => $description,
        'equipement_id' => $equipement_id,
        'user_id' => auth()->id(),
        'direction_id' => auth()->user()->direction_id
    ]);
}

}