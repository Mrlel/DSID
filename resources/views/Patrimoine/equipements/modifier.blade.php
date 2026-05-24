@extends('layouts.main-board')
@section('title', 'Modifier un équipement')
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

    
    .form-title {
        text-align: center;
        margin-bottom: 1.5rem;
        font-weight: 300;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        border:1px solid rgba(132, 246, 176, 0.48);
        padding: 1rem 0;
        border-radius: 5px;
    }
    
    .form-title img {
        font-size: 2rem;
        background-color: rgba(66, 255, 151, 0.1);
        padding: 2.5rem;
        border-radius: 50%;
    }
    
    .ui.form .field > label {
        color: #555;
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
        border-color: #ff8c42;
        box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.1);
    }
    
    .ui.primary.button {
        background: linear-gradient(135deg, #ff8c42 0%, #ff6b35 100%);
        border: none;
        border-radius: 8px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        margin-top: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 140, 66, 0.3);
    }
    
    .ui.primary.button:hover {
        background: linear-gradient(135deg, #ff6b35 0%, #ff5722 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 140, 66, 0.4);
    }
    
    .ui.negative.message {
        background: #fff5f5;
        border: 1px solid #fed7d7;
        border-radius: 8px;
        color: #c53030;
    }
    
    .field-group {
        background-color: #fff;
        border-radius: 12px;
        padding: 1.75rem;
        margin: 1.5rem 0;
    }
    
    .section-title {
        color: #2c3e50;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f5f5f5;
    }
    
    .section-title i {
        margin-right: 0.75rem;
        color: #ff8c42;
        font-size: 1.2rem;
    }
    
    .required-field::after {
        content: "*";
        color: #ff8c42;
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
</style>

<div class="form-container">
    <div class="form-wrapper">

    <div class="form-header">
                <h2>
                    <i class="fas fa-plus-circle"></i>
                    Modification équipement
                </h2>
                <p>Remplissez les informations ci-dessous pour modifier un équipement</p>
            </div>

        <form class="ui fluid form" action="{{ route('equipement.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $equipement->id }}">

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
                            <option value="accesoires informatiques" {{ old('nature', $equipement->nature) == 'accesoires informatiques' ? 'selected' : '' }}>Accessoires informatiques</option>
                            <option value="reseaux" {{ old('nature', $equipement->nature) == 'reseaux' ? 'selected' : '' }}>Réseaux</option>
                            <option value="informatiques et bureautiques" {{ old('nature', $equipement->nature) == 'informatiques et bureautiques' ? 'selected' : '' }}>Informatique et bureautique</option>
                            <option value="multimedia" {{ old('nature', $equipement->nature) == 'multimedia' ? 'selected' : '' }}>Multimédia</option>
                            <option value="telephonie et connectivite" {{ old('nature', $equipement->nature) == 'telephonie et connectivite' ? 'selected' : '' }}>Téléphonie et connectivité</option>
                            <option value="autre" {{ old('nature', $equipement->nature) == 'autre' ? 'selected' : '' }}>Autres</option>
                        </select>
                        @error('nature')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="field @error('categorie') error @enderror">
                        <label for="categorie" class="required-field">Catégorie</label>
                        <select name="categorie" id="categorie" class="ui search dropdown" required>
                            <option value="">-- Sélectionnez la catégorie --</option>
                            <option value="Ordinateur portable" {{ old('categorie', $equipement->categorie) == 'Ordinateur portable' ? 'selected' : '' }}>Ordinateur portable</option>
                            <option value="Ordinateur All-in-one" {{ old('categorie', $equipement->categorie) == 'Ordinateur All-in-one' ? 'selected' : '' }}>Ordinateur All-in-one</option>
                            <option value="unite centrale" {{ old('categorie', $equipement->categorie) == 'unite centrale' ? 'selected' : '' }}>Unité centrale</option>
                            <option value="Imprimante" {{ old('categorie', $equipement->categorie) == 'Imprimante' ? 'selected' : '' }}>Imprimante</option>
                            <option value="Scanner" {{ old('categorie', $equipement->categorie) == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                            <option value="clavier" {{ old('categorie', $equipement->categorie) == 'clavier' ? 'selected' : '' }}>Clavier</option>
                            <option value="souris" {{ old('categorie', $equipement->categorie) == 'souris' ? 'selected' : '' }}>Souris</option>
                            <option value="ecran" {{ old('categorie', $equipement->categorie) == 'ecran' ? 'selected' : '' }}>Écran</option>
                            <option value="Serveur" {{ old('categorie', $equipement->categorie) == 'Serveur' ? 'selected' : '' }}>Serveur</option>
                            <option value="Routeur" {{ old('categorie', $equipement->categorie) == 'Routeur' ? 'selected' : '' }}>Routeur</option>
                            <option value="Switch" {{ old('categorie', $equipement->categorie) == 'Switch' ? 'selected' : '' }}>Switch</option>
                            <option value="Onduleur" {{ old('categorie', $equipement->categorie) == 'Onduleur' ? 'selected' : '' }}>Onduleur</option>
                            <option value="Projecteur" {{ old('categorie', $equipement->categorie) == 'Projecteur' ? 'selected' : '' }}>Projecteur</option>
                            <option value="Téléphone IP" {{ old('categorie', $equipement->categorie) == 'Téléphone IP' ? 'selected' : '' }}>Téléphone IP</option>
                            <option value="pare-feu" {{ old('categorie', $equipement->categorie) == 'pare-feu' ? 'selected' : '' }}>Pare-feu</option>
                            <option value="photocopieuse" {{ old('categorie', $equipement->categorie) == 'photocopieuse' ? 'selected' : '' }}>Photocopieuse</option>
                            <option value="stockage" {{ old('categorie', $equipement->categorie) == 'stockage' ? 'selected' : '' }}>Stockage</option>
                            <option value="systeme visio conference" {{ old('categorie', $equipement->categorie) == 'systeme visio conference' ? 'selected' : '' }}>Système visioconférence</option>
                            <option value="Accessoire" {{ old('categorie', $equipement->categorie) == 'Accessoire' ? 'selected' : '' }}>Accessoire</option>
                            <option value="Autre" {{ old('categorie', $equipement->categorie) == 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('categorie')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="field @error('des_equipement') error @enderror">
                    <label for="des_equipement" class="required-field">Désignation</label>
                    <input type="text" name="des_equipement" id="des_equipement" 
                        value="{{ old('des_equipement', $equipement->des_equipement) }}" 
                        placeholder="Désignation de l'équipement" required>
                    @error('des_equipement')
                        <div class="ui pointing red basic label">{{ $message }}</div>
                    @enderror
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
                            <option value="Etat" {{ old('source_acquisition', $equipement->source_acquisition) == 'Etat' ? 'selected' : '' }}>État</option>
                            <option value="Bailleur" {{ old('source_acquisition', $equipement->source_acquisition) == 'Bailleur' ? 'selected' : '' }}>Bailleur</option>
                            <option value="autre" {{ old('source_acquisition', $equipement->source_acquisition) == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('source_acquisition')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field @error('etat') error @enderror">
                        <label for="etat" class="required-field">État de l'équipement</label>
                        <select name="etat" id="etat" class="ui search dropdown" required>
                            <option value="">-- Sélectionnez l'état --</option>
                            <option value="bon" {{ old('etat', $equipement->etat) == 'bon' ? 'selected' : '' }}>Bon état</option>
                            <option value="moyen" {{ old('etat', $equipement->etat) == 'moyen' ? 'selected' : '' }}>État moyen</option>
                            <option value="hors service" {{ old('etat', $equipement->etat) == 'hors service' ? 'selected' : '' }}>Hors service</option>
                        </select>
                        @error('etat')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="field @error('date_acquis') error @enderror">
                    <label for="date_acquis" class="required-field">Date d'acquisition</label>
                    <input type="date" name="date_acquis" id="date_acquis" 
                        value="{{ old('date_acquis', $equipement->date_acquis) }}" required>
                    @error('date_acquis')
                        <div class="ui pointing red basic label">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field @error('date_fin_vie') error @enderror">
                    <label for="date_fin_vie">Date de fin de durée de vie <span style="color:#888;font-weight:400;font-size:0.85rem;">(optionnel)</span></label>
                    <input type="date" name="date_fin_vie" id="date_fin_vie" 
                        value="{{ old('date_fin_vie', $equipement->date_fin_vie?->format('Y-m-d')) }}">
                    @error('date_fin_vie')
                        <div class="ui pointing red basic label">{{ $message }}</div>
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
                            value="{{ old('marque', $equipement->marque) }}" 
                            placeholder="Marque de l'équipement" required>
                        @error('marque')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field @error('modele') error @enderror">
                        <label for="modele" class="required-field">Modèle</label>
                        <input type="text" name="modele" id="modele" 
                            value="{{ old('modele', $equipement->modele) }}" 
                            placeholder="Modèle de l'équipement" required>
                        @error('modele')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="two fields">
                    <div class="field @error('numero_serie') error @enderror">
                        <label for="numero_serie" class="required-field">Numéro de série</label>
                        <input type="text" name="numero_serie" id="numero_serie" 
                            value="{{ old('numero_serie', $equipement->numero_serie) }}" 
                            placeholder="Numéro de série" required>
                        @error('numero_serie')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field @error('systeme') error @enderror">
                        <label for="systeme">Système d'exploitation</label>
                        <input type="text" name="systeme" id="systeme" 
                            value="{{ old('systeme', $equipement->systeme) }}" 
                            placeholder="Windows 10, Ubuntu, etc.">
                        @error('systeme')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="two fields">
                    <div class="field @error('capacite') error @enderror">
                        <label for="capacite">Capacité Disque Dur (Go)</label>
                        <input type="number" name="capacite" id="capacite" 
                            value="{{ old('capacite', $equipement->capacite) }}" 
                            placeholder="500">
                        @error('capacite')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field @error('ram') error @enderror">
                        <label for="ram">RAM (Go)</label>
                        <input type="number" name="ram" id="ram" 
                            value="{{ old('ram', $equipement->ram) }}" 
                            placeholder="8">
                        @error('ram')
                            <div class="ui pointing red basic label">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="field @error('adresse_mac') error @enderror">
                    <label for="adresse_mac">Adresse MAC</label>
                    <input type="text" name="adresse_mac" id="adresse_mac" 
                        value="{{ old('adresse_mac', $equipement->adresse_mac) }}" 
                        placeholder="00:1B:44:11:3A:B7">
                    @error('adresse_mac')
                        <div class="ui pointing red basic label">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="fluid ui primary button mb-4">
                <i class="save icon"></i> 
                Mettre à jour l'équipement
            </button>
        </form>
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