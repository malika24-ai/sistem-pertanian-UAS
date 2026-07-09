<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Nama Lahan</div>
            <div class="col-8 fw-semibold">{{ $farm->name }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Pemilik</div>
            <div class="col-8 fw-semibold">{{ $farm->user->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Lokasi</div>
            <div class="col-8 fw-semibold">{{ $farm->location }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Luas</div>
            <div class="col-8 fw-semibold">{{ number_format($farm->area, 2) }} m²</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Dibuat Pada</div>
            <div class="col-8 fw-semibold">{{ $farm->created_at->format('d M Y, H:i') }}</div>
        </div>
    </div>
</div>
