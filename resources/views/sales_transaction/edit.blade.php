<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('sales-transaction.update', $record) }}" method="post" class="form">
            @csrf
            @method('put')
            
            <div class="mb-3">
                <label for="buyer_id" class="form-label required">Pembeli</label>
                <select class="form-select select2-default @error('buyer_id') is-invalid @enderror" id="buyer_id" name="buyer_id" required>
                    <option value="">Pilih Pembeli</option>
                    @foreach ($buyers as $b)
                        <option value="{{ $b->id }}" @selected(old('buyer_id', $record->buyer_id) == $b->id)>{{ $b->name }}</option>
                    @endforeach
                </select>
                @error('buyer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="crop_id" class="form-label required">Hasil Panen (Crop)</label>
                <select class="form-select select2-default @error('crop_id') is-invalid @enderror" id="crop_id" name="crop_id" required>
                    <option value="">Pilih Crop</option>
                    @foreach ($crops as $c)
                        <option value="{{ $c->id }}" @selected(old('crop_id', $record->crop_id) == $c->id)>{{ $c->name ?? '-' }} (Lahan: {{ $c->farm->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('crop_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="transaction_date" class="form-label required">Tanggal Transaksi</label>
                <input class="form-control @error('transaction_date') is-invalid @enderror" type="date" id="transaction_date" name="transaction_date" required value="{{ old('transaction_date', $record->transaction_date) }}">
                @error('transaction_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label required">Jumlah (kg)</label>
                <input class="form-control @error('quantity') is-invalid @enderror" type="number" step="0.01" id="quantity" name="quantity" required value="{{ old('quantity', $record->quantity) }}">
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label required">Harga per kg (Rp)</label>
                <input class="form-control @error('price') is-invalid @enderror" type="number" step="0.01" id="price" name="price" required value="{{ old('price', $record->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('sales-transaction.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
