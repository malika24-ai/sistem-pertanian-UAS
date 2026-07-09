<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('weather-log.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="farm_id" class="form-label required">Lahan</label>
                <select class="form-select select2-default @error('farm_id') is-invalid @enderror" id="farm_id" name="farm_id" required>
                    <option value="">Pilih Lahan</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}" @selected(old('farm_id') == $farm->id)>{{ $farm->name }}</option>
                    @endforeach
                </select>
                @error('farm_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label required">Tanggal</label>
                <input class="form-control @error('date') is-invalid @enderror" type="date" id="date" name="date" required value="{{ old('date') }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="condition" class="form-label required">Kondisi Cuaca</label>
                <input class="form-control @error('condition') is-invalid @enderror" type="text" id="condition" name="condition" required value="{{ old('condition') }}" placeholder="Misal: Cerah, Hujan, Mendung">
                @error('condition')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="temperature" class="form-label required">Suhu (°C)</label>
                <input class="form-control @error('temperature') is-invalid @enderror" type="number" step="0.1" id="temperature" name="temperature" required value="{{ old('temperature') }}" placeholder="Misal: 28.5">
                @error('temperature')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="humidity" class="form-label required">Kelembaban (%)</label>
                <input class="form-control @error('humidity') is-invalid @enderror" type="number" step="0.1" id="humidity" name="humidity" required value="{{ old('humidity') }}" placeholder="Misal: 70">
                @error('humidity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('weather-log.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
