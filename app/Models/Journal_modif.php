<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal_modif extends Model
{
    use HasFactory;
    protected $fillable = [
        'action',
        'description',
        'equipement_id',
        'direction_id',
        'user_id',
    ];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
