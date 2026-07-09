<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('harvest-record.update', $record) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="crop_id" class="form-label required">Tanaman</label>
                <select class="form-select select2-default @error('crop_id') is-invalid @enderror" id="crop_id" name="crop_id" required>
                    <option value="">Pilih Tanaman</option>
                    @foreach ($crops as $c)
                        <option value="{{ $c->id }}" @selected(old('crop_id', $record->crop_id) == $c->id)>{{ $c->cropType->name ?? '-' }} (Lahan: {{ $c->farm->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('crop_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harvest_date" class="form-label required">Tanggal Panen</label>
                <input class="form-control @error('harvest_date') is-invalid @enderror" type="date" id="harvest_date" name="harvest_date" required value="{{ old('harvest_date', $record->harvest_date) }}">
                @error('harvest_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label required">Kuantitas (kg)</label>
                <input class="form-control @error('quantity') is-invalid @enderror" type="number" step="0.01" id="quantity" name="quantity" required value="{{ old('quantity', $record->quantity) }}">
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quality" class="form-label">Kualitas (Grade)</label>
                <select class="form-select @error('quality') is-invalid @enderror" id="quality" name="quality">
                    <option value="">Pilih Grade</option>
                    <option value="Grade A" @selected(old('quality', $record->quality) == 'Grade A')>Grade A</option>
                    <option value="Grade B" @selected(old('quality', $record->quality) == 'Grade B')>Grade B</option>
                    <option value="Grade C" @selected(old('quality', $record->quality) == 'Grade C')>Grade C</option>
                </select>
                @error('quality')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('harvest-record.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
