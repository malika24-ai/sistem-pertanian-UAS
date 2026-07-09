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
                        <option value="{{ $c->id }}" @selected(old('crop_id', $schedule->crop_id) == $c->id)>{{ $c->name ?? '-' }} (Lahan: {{ $c->farm->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('crop_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="plant_date" class="form-label required">Tanggal Tanam</label>
                <input class="form-control @error('plant_date') is-invalid @enderror" type="date" id="plant_date" name="plant_date" required value="{{ old('plant_date', $schedule->plant_date) }}">
                @error('plant_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="estimated_harvest_date" class="form-label required">Estimasi Panen</label>
                <input class="form-control @error('estimated_harvest_date') is-invalid @enderror" type="date" id="estimated_harvest_date" name="estimated_harvest_date" required value="{{ old('estimated_harvest_date', $schedule->estimated_harvest_date) }}">
                @error('estimated_harvest_date')
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
