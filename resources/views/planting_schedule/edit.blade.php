<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('planting-schedule.update', $schedule) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="crop_id" class="form-label required">Tanaman</label>
                <select class="form-select select2-default @error('crop_id') is-invalid @enderror" id="crop_id" name="crop_id" required>
                    <option value="">Pilih Tanaman</option>
                    @foreach ($crops as $c)
                        <option value="{{ $c->id }}" @selected(old('crop_id', $schedule->crop_id) == $c->id)>{{ $c->cropType->name ?? '-' }} (Lahan: {{ $c->farm->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('crop_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="activity_name" class="form-label required">Nama Aktivitas</label>
                <input class="form-control @error('activity_name') is-invalid @enderror" type="text" id="activity_name" name="activity_name" required value="{{ old('activity_name', $schedule->activity_name) }}">
                @error('activity_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="scheduled_date" class="form-label required">Tanggal Jadwal</label>
                <input class="form-control @error('scheduled_date') is-invalid @enderror" type="date" id="scheduled_date" name="scheduled_date" required value="{{ old('scheduled_date', $schedule->scheduled_date) }}">
                @error('scheduled_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label required">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="Pending" @selected(old('status', $schedule->status) == 'Pending')>Pending</option>
                    <option value="Completed" @selected(old('status', $schedule->status) == 'Completed')>Completed</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('planting-schedule.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
