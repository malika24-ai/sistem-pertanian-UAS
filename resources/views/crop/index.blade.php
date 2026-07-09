<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('crop.create') }}" role="button">Tambah Tanaman</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Tanaman</th>
                        <th scope="col">Lahan</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Tanggal Tanam</th>
                        <th scope="col">Estimasi Panen</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($crops as $crop)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $crop->name }}</td>
                            <td>{{ $crop->farm->name ?? '-' }}</td>
                            <td>{{ $crop->cropType->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($crop->plant_date)->format('d M Y') }}</td>
                            <td>{{ $crop->estimated_harvest_date ? \Carbon\Carbon::parse($crop->estimated_harvest_date)->format('d M Y') : '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $crop->status == 'Active' ? 'success' : ($crop->status == 'Harvested' ? 'info' : 'secondary') }}">
                                    {{ $crop->status }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-detail"
                                    data-route="{{ route('crop.show', $crop) }}">
                                    <i class='bx bx-show'></i>
                                </button>
                                <a href="{{ route('crop.edit', $crop) }}" class="btn btn-warning btn-sm">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('crop.destroy', $crop) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('modals')
        <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Detail Tanaman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="modal-detail">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            $('#data-table').on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })

            $('#data-table').on('click', '.btn-detail', function() {
                Swal.fire({
                    title: 'Memuat...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                $('#modal-detail').load($(this).data('route'), function(response, status, xhr) {
                    if (status == "success") {
                        setTimeout(() => {
                            Swal.close();
                            $('#detailModal').modal('show');
                        }, 500);
                    }
                });
            })
        </script>
    @endpush
</x-app>
