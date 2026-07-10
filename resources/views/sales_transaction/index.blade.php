<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('sales-transaction.create') }}" role="button">Tambah Transaksi</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Pembeli</th>
                        <th scope="col">Hasil Panen (Crop)</th>
                        <th scope="col">Jumlah (kg)</th>
                        <th scope="col">Harga/kg</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($record->transaction_date)->format('d M Y') }}</td>
                            <td>{{ $record->buyer->name ?? '-' }}</td>
                            <td>{{ $record->crop->name ?? '-' }} (Lahan: {{ $record->crop->farm->name ?? '-' }})</td>
                            <td>{{ number_format($record->quantity, 2) }}</td>
                            <td>Rp {{ number_format($record->price, 2) }}</td>
                            <td class="fw-bold">Rp {{ number_format($record->total, 2) }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-detail"
                                    data-route="{{ route('sales-transaction.show', $record) }}">
                                    <i class='bx bx-show'></i>
                                </button>
                                <a href="{{ route('sales-transaction.edit', $record) }}" class="btn btn-warning btn-sm">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('sales-transaction.destroy', $record) }}">
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
                        <h1 class="modal-title fs-5">Detail Transaksi Penjualan</h1>
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
