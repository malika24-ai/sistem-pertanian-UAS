<div class="list-group list-group-flush">
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Aktivitas</div>
            <div class="col-8 fw-semibold">{{ $schedule->activity_name }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Tanaman</div>
            <div class="col-8 fw-semibold">{{ $schedule->crop->cropType->name ?? '-' }}</div>
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
            <div class="col-4 text-muted">Tanggal Jadwal</div>
            <div class="col-8 fw-semibold">{{ \Carbon\Carbon::parse($schedule->scheduled_date)->format('d M Y') }}</div>
        </div>
    </div>
    <div class="list-group-item px-0 border-0">
        <div class="row">
            <div class="col-4 text-muted">Status</div>
            <div class="col-8 fw-semibold">
                <span class="badge bg-{{ $schedule->status == 'Completed' ? 'success' : 'warning' }}">
                    {{ $schedule->status }}
                </span>
            </div>
        </div>
    </div>
</div>
