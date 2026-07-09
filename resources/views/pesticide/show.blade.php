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
            <div class="col-4 text-muted">Nama Pestisida</div>
            <div class="col-8 fw-semibold">{{ $record->name }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Jenis</div>
            <div class="col-8 fw-semibold">{{ $record->type }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Dosis</div>
            <div class="col-8 fw-semibold">{{ $record->dosage }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tgl Penggunaan</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($record->usage_date)->format('d M Y') }}</div>
        </div>
    </div>
</div>
