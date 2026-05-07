@extends('layouts.main-board')

@section('content')
<div class="container-fluid">
    <h2 class="py-4 fw-bold text-dark">
        <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Journal d'activités
    </h2>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light rounded">
            <form method="GET" action="{{ route('journal.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-uppercase">Date début</label>
                    <input type="date" name="date_debut" value="{{ request('date_debut') }}" class="form-control border-0 shadow-sm">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-uppercase">Date fin</label>
                    <input type="date" name="date_fin" value="{{ request('date_fin') }}" class="form-control border-0 shadow-sm">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-uppercase">Action</label>
                    <select name="action" class="form-select border-0 shadow-sm">
                        <option value="">Toutes les actions</option>
                        <option value="création" {{ request('action') == 'création' ? 'selected' : '' }}>Création</option>
                        <option value="modification" {{ request('action') == 'modification' ? 'selected' : '' }}>Modification</option>
                        <option value="suppression" {{ request('action') == 'suppression' ? 'selected' : '' }}>Suppression</option>
                        <option value="attribution" {{ request('action') == 'attribution' ? 'selected' : '' }}>Attribution</option>
                        <option value="import" {{ request('action') == 'import' ? 'selected' : '' }}>Import</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">
                            <i class="fa-solid fa-filter me-1"></i> Filtrer
                        </button>
                        <a href="{{ route('journal.index') }}" class="btn btn-outline-secondary shadow-sm">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Date & Heure</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>Équipement</th>
                        <th>Acteur/Actrice</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($modifications as $modif)
                    <tr>
                        <td class="ps-4 text-muted">
                            <small class="fw-bold text-dark">{{ $modif->created_at->format('d/m/Y') }}</small><br>
                            <small>{{ $modif->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            @php
                                $badgeColor = match($modif->action) {
                                    'création' => 'bg-success',
                                    'modification' => 'bg-warning text-dark',
                                    'suppression' => 'bg-danger',
                                    'attribution' => 'bg-primary',
                                    'import' => 'bg-info text-dark',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeColor }} rounded-pill px-3">
                                {{ ucfirst($modif->action) }}
                            </span>
                        </td>
                        <td class="text-wrap" style="max-width: 300px;">
                            {{ $modif->description }}
                        </td>
                        <td>
                            <span class="fw-medium text-primary">
                                <i class="fa-solid fa-desktop me-1 small"></i>
                                {{ $modif->equipement->des_equipement ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2 bg-light rounded-circle text-center" style="width:30px; height:30px; line-height:30px;">
                                    <i class="fa-solid fa-user text-secondary"></i>
                                </div>
                                <span>{{ $modif->user->nom ?? 'N/A' }}</span>
                            </div>
                        </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-5 text-center text-muted">
                            <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                            Aucune modification enregistrée pour cette période.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection