<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanaman</div>
            <div class="col-8 fw-semibold">{{ $record->crop->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Lahan</div>
            <div class="col-8 fw-semibold">{{ $record->crop->farm->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanggal Panen</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($record->harvest_date)->format('d M Y') }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Kuantitas</div>
            <div class="col-8 fw-semibold">{{ number_format($record->quantity, 2) }} kg</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Kualitas</div>
            <div class="col-8 fw-semibold">
                <span class="badge bg-primary">
                    {{ $record->quality ?? '-' }}
                </span>
            </div>
        </div>
    </div>
</div>
