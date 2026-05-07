<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class UserImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use SkipsErrors;

    protected $direction_id;

    public function __construct($direction_id)
    {
        $this->direction_id = $direction_id;
    }

    public function model(array $row)
    {
        return new User([
            'nom' => $row['nom'],
            'prenom' => $row['prenom'] ?? null,
            'matricule' => $row['matricule'],
            'email' => $row['email'],
            'contact' => $row['contact'],
            'emploie' => $row['emploie'],
            'fonction' => $row['fonction'],
            'grade' => $row['grade'],
            'role' => $row['role'] ?? 'user',
            'direction_id' => $this->direction_id,
            'password' => Hash::make('12345678'), // Mot de passe par défaut
        ]);
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'matricule' => 'required|string|unique:users,matricule',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|string',
            'emploie' => 'required|string',
            'fonction' => 'required|string',
            'grade' => 'required|string',
            'role' => 'nullable|in:user,chef_de_service,admin',
        ];
    }
}