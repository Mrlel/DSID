@extends('layouts.main-board')
@section('title', 'Gestion des matériels en stock')
@section('content')

<style>
    /* Variables - Palette sobre et professionnelle */
    :root {
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --blue-500: #3b82f6;
        --blue-600: #2563eb;
        --red-500: #ef4444;
        --red-600: #dc2626;
        --green-500: #10b981;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    /* Reset et styles de base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .form-container {
        background: var(--gray-50);
        min-height: calc(100vh - 200px);
        padding: 2rem;
    }

    .form-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Carte principale - épurée */
    .form-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }

    /* En-tête minimal */
    .form-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--gray-200);
        background: white;
    }

    .form-header h2 {
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-header p {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin: 0.25rem 0 0 0;
    }

    /* Corps du formulaire */
    .form-body {
        padding: 2rem;
    }

    /* Sections - sans fioritures */
    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-title {
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray-500);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--gray-400);
        font-size: 0.875rem;
    }

    /* Grilles propres */
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .form-row:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }

    /* Champs - minimalistes */
    .field {
        margin-bottom: 0;
    }

    .field label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 0.375rem;
    }

    .required-field::after {
        content: '*';
        color: var(--red-500);
        margin-left: 0.25rem;
    }

    .field input,
    .field select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-family: inherit;
        border: 1px solid var(--gray-300);
        border-radius: 0.375rem;
        background: white;
        transition: all 0.15s ease;
        outline: none;
    }

    .field input:focus,
    .field select:focus {
        border-color: var(--blue-500);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .field input.error,
    .field select.error {
        border-color: var(--red-500);
    }

    .field input.error:focus,
    .field select.error:focus {
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1);
    }

    /* Message d'erreur - simple */
    .error-message {
        font-size: 0.75rem;
        color: var(--red-600);
        margin-top: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Alertes - épurées */
    .alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 0.375rem;
        padding: 0.875rem 1rem;
        margin-bottom: 1.5rem;
    }

    .alert .header {
        font-weight: 500;
        color: var(--red-600);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
        color: var(--red-600);
        font-size: 0.8125rem;
    }

    /* Boutons - sobres */
    .btn-primary {
        background: var(--gray-900);
        color: white;
        border: none;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: background 0.15s ease;
        margin-bottom: 0.75rem;
    }

    .btn-primary:hover {
        background: var(--gray-800);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary {
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        text-decoration: none;
    }

    /* Indice de champ - discret */
    .field-hint {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 0.25rem;
    }

    /* Modal minimaliste */
    .modal-custom .modal-content {
        border-radius: 0.5rem;
        border: 1px solid var(--gray-200);
    }

    .modal-custom .modal-header {
        background: white;
        color: var(--gray-900);
        border-bottom: 1px solid var(--gray-200);
        padding: 1rem 1.5rem;
    }

    .modal-custom .modal-header .btn-close {
        filter: none;
        opacity: 0.5;
    }

    /* Checkbox et radio épurés */
    .inline-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-right: 1rem;
        font-weight: normal;
        cursor: pointer;
    }

    .inline-label input {
        width: auto;
        margin: 0;
    }
</style>

<div class="form-container">
    <div class="form-wrapper">
        <div class="form-card">
            <div class="form-header">
                <h2>
                    <i class="fas fa-plus-circle"></i>
                    Nouvel équipement
                </h2>
                <p>Remplissez les informations ci-dessous pour ajouter un équipement à l'inventaire</p>
            </div>
            
            <div class="form-body">
                <form action="{{ route('ordinateur.save') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="alert">
                            <div class="header">
                                <i class="exclamation triangle icon"></i>
                                Veuillez corriger les erreurs suivantes
                            </div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Section 1: Informations générales -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="info circle icon"></i>
                            Informations générales
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="nature" class="required-field">Nature</label>
                                <select name="nature" id="nature" class="ui search dropdown @error('nature') error @enderror" required>
                                    <option value="">Sélectionner</option>
                                    <option value="accesoires informatiques" {{ old('nature') == 'accesoires informatiques' ? 'selected' : '' }}>Accessoires informatiques</option>
                                    <option value="reseaux" {{ old('nature') == 'reseaux' ? 'selected' : '' }}>Réseaux</option>
                                    <option value="informatiques et bureautiques" {{ old('nature') == 'informatiques et bureautiques' ? 'selected' : '' }}>Informatique et bureautique</option>
                                    <option value="multimedia" {{ old('nature') == 'multimedia' ? 'selected' : '' }}>Multimédia</option>
                                    <option value="telephonie et connectivite" {{ old('nature') == 'telephonie et connectivite' ? 'selected' : '' }}>Téléphonie et connectivité</option>
                                    <option value="autre" {{ old('nature') == 'autre' ? 'selected' : '' }}>Autres</option>
                                </select>
                                @error('nature')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        
                            <div class="field">
                                <label for="categorie" class="required-field">Catégorie</label>
                                <select name="categorie" id="categorie" class="ui search dropdown @error('categorie') error @enderror" required>
                                    <option value="">Sélectionner</option>
                                    <option value="Ordinateur portable" {{ old('categorie') == 'Ordinateur portable' ? 'selected' : '' }}>Ordinateur portable</option>
                                    <option value="Ordinateur All-in-one" {{ old('categorie') == 'Ordinateur All-in-one' ? 'selected' : '' }}>Ordinateur All-in-one</option>
                                    <option value="unite centrale" {{ old('categorie') == 'unite centrale' ? 'selected' : '' }}>Unité centrale</option>
                                    <option value="Imprimante" {{ old('categorie') == 'Imprimante' ? 'selected' : '' }}>Imprimante</option>
                                    <option value="Scanner" {{ old('categorie') == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                                    <option value="clavier" {{ old('categorie') == 'clavier' ? 'selected' : '' }}>Clavier</option>
                                    <option value="souris" {{ old('categorie') == 'souris' ? 'selected' : '' }}>Souris</option>
                                    <option value="ecran" {{ old('categorie') == 'ecran' ? 'selected' : '' }}>Écran</option>
                                    <option value="Serveur" {{ old('categorie') == 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                    <option value="Routeur" {{ old('categorie') == 'Routeur' ? 'selected' : '' }}>Routeur</option>
                                    <option value="Switch" {{ old('categorie') == 'Switch' ? 'selected' : '' }}>Switch</option>
                                    <option value="Onduleur" {{ old('categorie') == 'Onduleur' ? 'selected' : '' }}>Onduleur</option>
                                    <option value="Projecteur" {{ old('categorie') == 'Projecteur' ? 'selected' : '' }}>Projecteur</option>
                                    <option value="Téléphone IP" {{ old('categorie') == 'Téléphone IP' ? 'selected' : '' }}>Téléphone IP</option>
                                    <option value="pare-feu" {{ old('categorie') == 'pare-feu' ? 'selected' : '' }}>Pare-feu</option>
                                    <option value="photocopieuse" {{ old('categorie') == 'photocopieuse' ? 'selected' : '' }}>Photocopieuse</option>
                                    <option value="stockage" {{ old('categorie') == 'stockage' ? 'selected' : '' }}>Stockage</option>
                                    <option value="systeme visio conference" {{ old('categorie') == 'systeme visio conference' ? 'selected' : '' }}>Système visioconférence</option>
                                    <option value="Accessoire" {{ old('categorie') == 'Accessoire' ? 'selected' : '' }}>Accessoire</option>
                                    <option value="Autre" {{ old('categorie') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('categorie')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="field">
                                <label for="des_equipement" class="required-field">Désignation</label>
                                <input type="text" name="des_equipement" id="des_equipement" 
                                    value="{{ old('des_equipement') }}" 
                                    placeholder="Ex: Dell Latitude 5420" required>
                                @error('des_equipement')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Inventaire et état -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="clipboard list icon"></i>
                            Inventaire
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="source_acquisition" class="required-field">Mode d'acquisition</label>
                                <select name="source_acquisition" id="source_acquisition" class="ui search dropdown @error('source_acquisition') error @enderror" required>
                                    <option value="">Sélectionner</option>
                                    <option value="Etat" {{ old('source_acquisition') == 'Etat' ? 'selected' : '' }}>État</option>
                                    <option value="Bailleur" {{ old('source_acquisition') == 'Bailleur' ? 'selected' : '' }}>Bailleur</option>
                                    <option value="autre" {{ old('source_acquisition') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('source_acquisition')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="etat" class="required-field">État</label>
                                <select name="etat" id="etat" class="ui search dropdown @error('etat') error @enderror" required>
                                    <option value="">Sélectionner</option>
                                    <option value="bon" {{ old('etat') == 'bon' ? 'selected' : '' }}>Bon</option>
                                    <option value="moyen" {{ old('etat') == 'moyen' ? 'selected' : '' }}>Moyen</option>
                                    <option value="hors service" {{ old('etat') == 'hors service' ? 'selected' : '' }}>Hors service</option>
                                </select>
                                @error('etat')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="date_acquis" class="required-field">Date d'acquisition</label>
                                <input type="date" name="date_acquis" id="date_acquis" 
                                    value="{{ old('date_acquis') }}" required>
                                @error('date_acquis')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="date_fin_vie">Fin de vie</label>
                                <input type="date" name="date_fin_vie" id="date_fin_vie" 
                                    value="{{ old('date_fin_vie') }}">
                                <div class="field-hint">
                                    <i class="info circle icon"></i> Optionnel
                                </div>
                                @error('date_fin_vie')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            
                            <div class="field">
                                <label for="date_fin_vie">Date d'exploitation</label>
                                <input type="date" id="date_fin_vie" 
                                    value="{{ old('date_fin_vie') }}">
                                <div class="field-hint">
                                    <i class="info circle icon"></i> Optionnel
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Caractéristiques techniques -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="cog icon"></i>
                            Spécifications
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="marque" class="required-field">Marque</label>
                                <input type="text" name="marque" id="marque" 
                                    value="{{ old('marque') }}" 
                                    placeholder="Dell, HP, Lenovo..." required>
                                @error('marque')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="modele" class="required-field">Modèle</label>
                                <input type="text" name="modele" id="modele" 
                                    value="{{ old('modele') }}" 
                                    placeholder="Latitude 5420" required>
                                @error('modele')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="numero_serie" class="required-field">N° de série</label>
                                <input type="text" name="numero_serie" id="numero_serie" 
                                    value="{{ old('numero_serie') }}" 
                                    placeholder="CN-12345-67890" required>
                                @error('numero_serie')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="systeme">Système d'exploitation</label>
                                <input type="text" name="systeme" id="systeme" 
                                    value="{{ old('systeme') }}" 
                                    placeholder="Windows 11, Ubuntu 22.04">
                                @error('systeme')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="capacite">Disque dur (Go)</label>
                                <input type="number" name="capacite" id="capacite" 
                                    value="{{ old('capacite') }}" 
                                    placeholder="512">
                                @error('capacite')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="ram">RAM (Go)</label>
                                <input type="number" name="ram" id="ram" 
                                    value="{{ old('ram') }}" 
                                    placeholder="16">
                                @error('ram')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="field">
                                <label for="adresse_mac">Adresse MAC</label>
                                <input type="text" name="adresse_mac" id="adresse_mac" 
                                    value="{{ old('adresse_mac') }}" 
                                    placeholder="00:1B:44:11:3A:B7">
                                <div class="field-hint">
                                    <i class="info circle icon"></i> Format XX:XX:XX:XX:XX:XX
                                </div>
                                @error('adresse_mac')
                                    <div class="error-message">
                                        <i class="exclamation circle icon"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="save icon"></i> 
                        Enregistrer
                    </button>
                    
                    <a href="{{ route('poste-complet.create') }}" class="btn-secondary">
                        <i class="fas fa-desktop"></i> 
                        Créer un desktop
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal minimaliste -->
<div class="modal fade modal-custom" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-6 fw-semibold" id="importModalLabel">
                    <i class="fas fa-file-excel me-2"></i>
                    Importer des équipements
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                @if(session('success'))
                    <div class="alert alert-success" style="background: #f0fdf4; border-color: #bbf7d0; color: #166534;">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert" style="background: #fef2f2; border-color: #fecaca;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('equipement.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="fichier" class="form-label" style="font-size: 0.8125rem; font-weight: 500;">Fichier Excel</label>
                        <input type="file" name="fichier" id="fichier" class="form-control" required accept=".xlsx,.xls">
                        <div class="field-hint mt-1">
                            <i class="fas fa-info-circle me-1"></i>
                            .xlsx ou .xls
                        </div>
                    </div>
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn-primary" style="margin-bottom: 0;">
                            <i class="fas fa-upload me-2"></i> 
                            Importer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialisation des dropdowns Semantic UI
        $('.ui.dropdown').dropdown({
            forceSelection: false,
            selectOnKeydown: false
        });
        
        // Formatage automatique de l'adresse MAC
        $('#adresse_mac').on('input', function() {
            let value = $(this).val().toUpperCase();
            value = value.replace(/[^0-9A-F]/g, '');
            if (value.length > 2) value = value.match(/.{1,2}/g).join(':');
            if (value.length > 17) value = value.substring(0, 17);
            $(this).val(value);
        });
    });
</script>

@endsection