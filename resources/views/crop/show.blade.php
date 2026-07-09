<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Nama Tanaman</div>
            <div class="col-8 fw-semibold">{{ $crop->name }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Lahan</div>
            <div class="col-8 fw-semibold">{{ $crop->farm->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Jenis Tanaman</div>
            <div class="col-8 fw-semibold">{{ $crop->cropType->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanggal Tanam</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($crop->plant_date)->format('d M Y') }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Estimasi Panen</div>
            <div class="col-8 fw-semibold">{{ $crop->estimated_harvest_date ? \Carbon\Carbon::parse($crop->estimated_harvest_date)->format('d M Y') : '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Status</div>
            <div class="col-8 fw-semibold">
                <span class="badge bg-{{ $crop->status == 'Active' ? 'success' : ($crop->status == 'Harvested' ? 'info' : 'secondary') }}">
                    {{ $crop->status }}
                </span>
            </div>
        </div>
    </div>
</div>
