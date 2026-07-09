<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('farm.update', $farm) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="user_id" class="form-label required">Pemilik (Petani)</label>
                <select class="form-select select2-default @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">Pilih Petani</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}" @selected(old('user_id', $farm->user_id) == $u->id)>{{ $u->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label required">Nama Lahan</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required value="{{ old('name', $farm->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label required">Lokasi</label>
                <input class="form-control @error('location') is-invalid @enderror" type="text" id="location" name="location" required value="{{ old('location', $farm->location) }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="area" class="form-label required">Luas Lahan (m²)</label>
                <input class="form-control @error('area') is-invalid @enderror" type="number" step="0.01" id="area" name="area" required value="{{ old('area', $farm->area) }}">
                @error('area')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('farm.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
