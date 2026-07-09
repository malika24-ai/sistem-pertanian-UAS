<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Lahan</div>
            <div class="col-8 fw-semibold">{{ $record->farm->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanggal</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Kondisi Cuaca</div>
            <div class="col-8 fw-semibold">{{ $record->condition }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Suhu</div>
            <div class="col-8 fw-semibold">{{ $record->temperature }} °C</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Kelembaban</div>
            <div class="col-8 fw-semibold">{{ $record->humidity }} %</div>
        </div>
    </div>
</div>
