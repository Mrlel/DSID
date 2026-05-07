@extends('layouts.main-board')
@section('title', 'Gestion des matériels en stock')
@section('content')

<style>
    :root {
        --orange-iv: #FF8C00;
        --vert-iv: #009E60;
        --blanc-iv: #FFFFFF;
        --orange-clair: #FFB347;
        --vert-clair: #90EE90;
    }
    
    .form-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .form-title {
        text-align: center;
        margin-bottom: 1.5rem;
        font-weight: 300;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        border: 2px solid var(--orange-iv);
        padding: 1rem 0;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(255, 140, 0, 0.05) 0%, rgba(0, 158, 96, 0.05) 100%);
    }
    
    .form-title img {
        font-size: 2rem;
        background: linear-gradient(135deg, var(--orange-iv) 0%, var(--vert-iv) 100%);
        padding: 2.5rem;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
    }
    
    .header-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .header-form button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }
    
    .header-form button i {
        font-size: 1rem;
    }
    
    .header-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .header-form button:first-child {
        background-color: rgba(0, 158, 96, 0.1);
        color: var(--vert-iv);
        border: 2px solid var(--vert-iv);
    }
    
    .header-form button:first-child:hover {
        background-color: var(--vert-iv);
        color: white;
    }
    
    .header-form button:last-child {
        background-color: rgba(255, 140, 0, 0.1);
        color: var(--orange-iv);
        border: 2px solid var(--orange-iv);
    }
    
    .header-form button:last-child:hover {
        background-color: var(--orange-iv);
        color: white;
    }
    
    .ui.form .field > label {
        color: #2C3E50;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .ui.form input, 
    .ui.dropdown {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.8rem 1rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    
    .ui.form input:focus,
    .ui.dropdown.active {
        border-color: var(--orange-iv);
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.15);
    }
    
    .ui.primary.button {
        background: linear-gradient(135deg, var(--orange-iv) 0%, var(--orange-clair) 100%);
        border: none;
        border-radius: 8px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        margin-top: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
        color: white;
    }
    
    .ui.primary.button:hover {
        background: linear-gradient(135deg, #e67e00 0%, var(--orange-iv) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 140, 0, 0.4);
    }
    
    .ui.success.button {
        background: linear-gradient(135deg, var(--vert-iv) 0%, var(--vert-clair) 100%);
        border: none;
        border-radius: 8px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 158, 96, 0.3);
        color: white;
    }
    
    .ui.success.button:hover {
        background: linear-gradient(135deg, #008a54 0%, var(--vert-iv) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 158, 96, 0.4);
    }
    
    .ui.negative.message {
        background: #fff5f5;
        border: 1px solid #fed7d7;
        border-radius: 8px;
        color: #c53030;
    }
    
    .field-group {
        background: linear-gradient(145deg, rgba(255, 140, 0, 0.02) 0%, rgba(0, 158, 96, 0.02) 100%);
        border: 1px solid rgba(255, 140, 0, 0.2);
        border-radius: 12px;
        padding: 1.75rem;
        margin: 1.5rem 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .section-title {
        color: #2c3e50;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid transparent;
        border-image: linear-gradient(90deg, var(--orange-iv) 0%, var(--vert-iv) 100%);
        border-image-slice: 1;
    }
    
    .section-title i {
        margin-right: 0.75rem;
        background: linear-gradient(135deg, var(--orange-iv) 0%, var(--vert-iv) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.2rem;
    }
    
    .ui.dropdown .menu {
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .ui.dropdown .menu > .item:hover {
        background: linear-gradient(90deg, rgba(255, 140, 0, 0.1) 0%, rgba(0, 158, 96, 0.1) 100%);
    }
    
    .required-field::after {
        content: "*";
        color: var(--orange-iv);
        margin-left: 4px;
    }
    
    .field.error input,
    .field.error .dropdown {
        border-color: #e0b4b4 !important;
    }
    
    .field.error .message {
        color: #9f3a38;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    
    .ui.pointing.red.basic.label {
        border-color: var(--orange-iv) !important;
        color: var(--orange-iv) !important;
    }
    
    @media (max-width: 768px) {
        .form-container {
            width: 95%;
            margin: 1rem auto;
        }
        
        .form-wrapper {
            padding: 1rem;
        }
        
        .ui.form .two.fields {
            flex-direction: column;
        }
        
        .ui.form .two.fields > .field {
            width: 100% !important;
            margin-bottom: 1rem;
        }
        
        .header-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .header-form button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <div class="form-wrapper">
        <form class="ui fluid form" action="{{ route('ordinateur.save') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="ui negative message">
                    <div class="header">
                        <i class="exclamation triangle icon"></i>
                        Erreurs détectées :
                    </div>
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section 1: General Information -->
            <div class="field-group">
                <div class="section-title">
                    <i class="info circle icon"></i>
                    Informations générales
                </div>
                
                <div class="two fields">
                    
                    <div class="field @error('nature') error @enderror">
                        <label for="nature" class="required-field">Nature de l'équipement</label>
                        <select name="nature" id="nature" class="ui search dropdown" required>
                            <option value="">-- Sélectionnez la nature --</option>
                            <option value="accesoires informatiques" {{ old('nature') == 'accesoires informatiques' ? 'selected' : '' }}>Accessoires informatiques</option>
                            <option value="reseaux" {{ old('nature') == 'reseaux' ? 'selected' : '' }}>Réseaux</option>
                            <option value="informatiques et bureautiques" {{ old('nature') == 'informatiques et bureautiques' ? 'selected' : '' }}>Informatique et bureautique</option>
                            <option value="multimedia" {{ old('nature') == 'multimedia' ? 'selected' : '' }}>Multimédia</option>
                            <option value="telephonie et connectivite" {{ old('nature') == 'telephonie et connectivite' ? 'selected' : '' }}>Téléphonie et connectivité</option>
                            <option value="autre" {{ old('nature') == 'autre' ? 'selected' : '' }}>Autres</option>
                        </select>
                        @error('nature')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="field @error('categorie') error @enderror">
                        <label for="categorie" class="required-field">Catégorie</label>
                        <select name="categorie" id="categorie" class="ui search dropdown" required>
                            <option value="">-- Sélectionnez la catégorie --</option>
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
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="field @error('des_equipement') error @enderror">
                        <label for="des_equipement" class="required-field">Désignation</label>
                        <input type="text" name="des_equipement" id="des_equipement" 
                            value="{{ old('des_equipement') }}" 
                            placeholder="Désignation de l'équipement" required>
                        @error('des_equipement')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Inventory and Status -->
            <div class="field-group">
                <div class="section-title">
                    <i class="clipboard list icon"></i>
                    Inventaire et état
                </div>
                
                <div class="two fields">
                    <div class="field @error('source_acquisition') error @enderror">
                        <label for="source_acquisition" class="required-field">Mode d'acquisition</label>
                        <select name="source_acquisition" id="source_acquisition" class="ui search dropdown" required>
                            <option value="">-- Sélectionnez le mode --</option>
                            <option value="Etat" {{ old('source_acquisition') == 'Etat' ? 'selected' : '' }}>État</option>
                            <option value="Bailleur" {{ old('source_acquisition') == 'Bailleur' ? 'selected' : '' }}>Bailleur</option>
                            <option value="autre" {{ old('source_acquisition') == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('source_acquisition')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="field @error('etat') error @enderror">
                        <label for="etat" class="required-field">État de l'équipement</label>
                        <select name="etat" id="etat" class="ui search dropdown" required>
                            <option value="">-- Sélectionnez l'état --</option>
                            <option value="bon" {{ old('etat') == 'bon' ? 'selected' : '' }}>Bon état</option>
                            <option value="moyen" {{ old('etat') == 'moyen' ? 'selected' : '' }}>État moyen</option>
                            <option value="hors service" {{ old('etat') == 'hors service' ? 'selected' : '' }}>Hors service</option>
                        </select>
                        @error('etat')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                    <div class="fluid field @error('date_acquis') error @enderror">
                        <label for="date_acquis" class="required-field">Date d'acquisition</label>
                        <input type="date" name="date_acquis" id="date_acquis" 
                            value="{{ old('date_acquis') }}" required>
                        @error('date_acquis')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
            </div>

            <!-- Section 3: Technical Specifications -->
            <div class="field-group">
                <div class="section-title">
                    <i class="cog icon"></i>
                    Caractéristiques techniques
                </div>
                
                <div class="two fields">
                    <div class="field @error('marque') error @enderror">
                        <label for="marque" class="required-field">Marque</label>
                        <input type="text" name="marque" id="marque" 
                            value="{{ old('marque') }}" 
                            placeholder="Marque de l'équipement" required>
                        @error('marque')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="field @error('modele') error @enderror">
                        <label for="modele" class="required-field">Modèle</label>
                        <input type="text" name="modele" id="modele" 
                            value="{{ old('modele') }}" 
                            placeholder="Modèle de l'équipement" required>
                        @error('modele')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="two fields">
                    <div class="field @error('numero_serie') error @enderror">
                        <label for="numero_serie" class="required-field">Numéro de série</label>
                        <input type="text" name="numero_serie" id="numero_serie" 
                            value="{{ old('numero_serie') }}" 
                            placeholder="Numéro de série" required>
                        @error('numero_serie')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="field @error('systeme') error @enderror">
                        <label for="systeme">Système d'exploitation</label>
                        <input type="text" name="systeme" id="systeme" 
                            value="{{ old('systeme') }}" 
                            placeholder="Windows 10, Ubuntu, etc.">
                        @error('systeme')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="two fields">
                    <div class="field @error('capacite') error @enderror">
                        <label for="capacite">Capacité Disque Dur (Go)</label>
                        <input type="number" name="capacite" id="capacite" 
                            value="{{ old('capacite') }}" 
                            placeholder="500">
                        @error('capacite')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="field @error('ram') error @enderror">
                        <label for="ram">RAM (Go)</label>
                        <input type="number" name="ram" id="ram" 
                            value="{{ old('ram') }}" 
                            placeholder="8">
                        @error('ram')
                            <div class="ui pointing red basic label">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="field @error('adresse_mac') error @enderror">
                    <label for="adresse_mac">Adresse MAC</label>
                    <input type="text" name="adresse_mac" id="adresse_mac" 
                        value="{{ old('adresse_mac') }}" 
                        placeholder="00:1B:44:11:3A:B7">
                    @error('adresse_mac')
                        <div class="ui pointing red basic label">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="fluid ui primary button mb-4">
                <i class="save icon"></i> 
                Enregistrer l'équipement
            </button>
            <a href="{{ route('poste-complet.create') }}" class="fluid ui success button P-2">
                <i class="fas fa-desktop"></i> Créer un desktop
            </a>
        </form>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fs-5 fw-semibold" id="importModalLabel">Importer des équipements</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any()))
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('equipement.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="fichier" class="form-label">Fichier Excel (.xlsx ou .xls)</label>
                        <input type="file" name="fichier" id="fichier" class="form-control" required>
                        <div class="form-text">Téléchargez un fichier Excel contenant les équipements</div>
                    </div>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i> Importer
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
        $('.ui.dropdown').dropdown({
            forceSelection: false,
            selectOnKeydown: false
        });
        
        // Auto-format MAC address
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