
<div class="panel">
    <div class="panel-header">
        <h2 class="panel-title">Assigner un administrateur à {{ $direction->nom_direction }}</h2>
    </div>
    <div class="panel-body">
        <form action="{{ route('directions.store-assign-admin', $direction->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="admin_id">Sélectionner un administrateur</label>
                <select name="admin_id" id="admin_id" class="form-control" required>
                    <option value="">Sélectionner un administrateur</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">
                            {{ $admin->nom }} ({{ $admin->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assigner</button>
        </form>
    </div>
</div>
