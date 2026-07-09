<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanaman</div>
            <div class="col-8 fw-semibold">{{ $schedule->crop->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Lahan</div>
            <div class="col-8 fw-semibold">{{ $schedule->crop->farm->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanggal Tanam</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($schedule->plant_date)->format('d M Y') }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Estimasi Panen</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($schedule->estimated_harvest_date)->format('d M Y') }}</div>
        </div>
    </div>
</div>
