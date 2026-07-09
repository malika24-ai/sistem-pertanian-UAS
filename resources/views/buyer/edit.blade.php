<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('buyer.update', $record) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="name" class="form-label required">Nama Pembeli</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required value="{{ old('name', $record->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label required">Kontak</label>
                <input class="form-control @error('contact') is-invalid @enderror" type="text" id="contact" name="contact" required value="{{ old('contact', $record->contact) }}">
                @error('contact')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label required">Alamat</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required rows="3">{{ old('address', $record->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label required">Jenis Pembeli</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Koperasi" @selected(old('type', $record->type) == 'Koperasi')>Koperasi</option>
                    <option value="Pasar Lokal" @selected(old('type', $record->type) == 'Pasar Lokal')>Pasar Lokal</option>
                    <option value="Supermarket" @selected(old('type', $record->type) == 'Supermarket')>Supermarket</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('buyer.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
