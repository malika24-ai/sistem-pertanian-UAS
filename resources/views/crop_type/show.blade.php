<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Nama Jenis</div>
            <div class="col-8 fw-semibold">{{ $cropType->name }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Deskripsi</div>
            <div class="col-8 fw-semibold">{{ $cropType->description ?? '-' }}</div>
        </div>
    </div>
</div>
