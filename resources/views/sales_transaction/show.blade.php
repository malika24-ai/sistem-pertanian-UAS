<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanggal Transaksi</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($record->transaction_date)->format('d M Y') }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Pembeli</div>
            <div class="col-8 fw-semibold">{{ $record->buyer->name ?? '-' }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Hasil Panen (Crop)</div>
            <div class="col-8 fw-semibold">{{ $record->crop->name ?? '-' }} (Lahan: {{ $record->crop->farm->name ?? '-' }})</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Jumlah</div>
            <div class="col-8 fw-semibold">{{ number_format($record->quantity, 2) }} kg</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Harga per kg</div>
            <div class="col-8 fw-semibold">Rp {{ number_format($record->price, 2) }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Total Harga</div>
            <div class="col-8 fw-bold text-success">Rp {{ number_format($record->total, 2) }}</div>
        </div>
    </div>
</div>
