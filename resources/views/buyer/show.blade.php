<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Nama Pembeli</div>
            <div class="col-8 fw-semibold">{{ $record->name }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Kontak</div>
            <div class="col-8 fw-semibold">{{ $record->contact }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Alamat</div>
            <div class="col-8 fw-semibold">{{ $record->address }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Jenis Pembeli</div>
            <div class="col-8 fw-semibold">
                <span class="badge bg-primary">
                    {{ $record->type }}
                </span>
            </div>
        </div>
    </div>
</div>
