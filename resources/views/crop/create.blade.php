<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('crop.store') }}" method="post" class="form">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label required">Nama Tanaman</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Misal: Padi Blok A">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="farm_id" class="form-label required">Lahan</label>
                <select class="form-select select2-default @error('farm_id') is-invalid @enderror" id="farm_id" name="farm_id" required>
                    <option value="">Pilih Lahan</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}" @selected(old('farm_id') == $farm->id)>{{ $farm->name }} (Pemilik: {{ $farm->user->name ?? '-' }})</option>
                    @endforeach
                </select>
                @error('farm_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="crop_type_id" class="form-label required">Jenis Tanaman</label>
                <select class="form-select select2-default @error('crop_type_id') is-invalid @enderror" id="crop_type_id" name="crop_type_id" required>
                    <option value="">Pilih Jenis</option>
                    @foreach ($cropTypes as $type)
                        <option value="{{ $type->id }}" @selected(old('crop_type_id') == $type->id)>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('crop_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="plant_date" class="form-label required">Tanggal Tanam</label>
                <input class="form-control @error('plant_date') is-invalid @enderror" type="date" id="plant_date" name="plant_date" required value="{{ old('plant_date') }}">
                @error('plant_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="estimated_harvest_date" class="form-label">Estimasi Panen</label>
                <input class="form-control @error('estimated_harvest_date') is-invalid @enderror" type="date" id="estimated_harvest_date" name="estimated_harvest_date" value="{{ old('estimated_harvest_date') }}">
                @error('estimated_harvest_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label required">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="Active" @selected(old('status') == 'Active')>Active</option>
                    <option value="Harvested" @selected(old('status') == 'Harvested')>Harvested</option>
                    <option value="Failed" @selected(old('status') == 'Failed')>Failed</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('crop.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-app>
