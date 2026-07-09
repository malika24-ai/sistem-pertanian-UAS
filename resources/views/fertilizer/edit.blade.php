<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('fertilizer.update', $record) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="crop_id" class="form-label required">Tanaman</label>
                <select class="form-select select2-default @error('crop_id') is-invalid @enderror" id="crop_id" name="crop_id" required>
                    <option value="">Pilih Tanaman</option>
                    @foreach ($crops as $c)
                        <option value="{{ $c->id }}" @selected(old('crop_id', $record->crop_id) == $c->id)>{{ $c->name ?? '-' }} (Lahan: {{ $c->farm->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('crop_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label required">Nama Pupuk</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required value="{{ old('name', $record->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label required">Jenis</label>
                <input class="form-control @error('type') is-invalid @enderror" type="text" id="type" name="type" required value="{{ old('type', $record->type) }}">
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dosage" class="form-label required">Dosis</label>
                <input class="form-control @error('dosage') is-invalid @enderror" type="text" id="dosage" name="dosage" required value="{{ old('dosage', $record->dosage) }}">
                @error('dosage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="usage_date" class="form-label required">Tgl Penggunaan</label>
                <input class="form-control @error('usage_date') is-invalid @enderror" type="date" id="usage_date" name="usage_date" required value="{{ old('usage_date', $record->usage_date) }}">
                @error('usage_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('fertilizer.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
