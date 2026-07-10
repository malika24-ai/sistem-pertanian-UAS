<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">
        <form action="{{ route('report.export_excel') }}" method="post" class="form" id="report-form">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="period_type" class="form-label required">Jenis Periode</label>
                        <select class="form-select @error('period_type') is-invalid @enderror" id="period_type"
                            name="period_type" required>
                            <option value="monthly" @selected(old('period_type') == 'monthly')>Bulanan</option>
                            <option value="yearly" @selected(old('period_type') == 'yearly')>Tahunan</option>
                        </select>
                        @error('period_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4" id="month-container">
                    <div class="mb-3">
                        <label for="month" class="form-label required">Bulan</label>
                        <select class="form-select @error('month') is-invalid @enderror" id="month" name="month">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" @selected(old('month', date('n')) == $m)>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        @error('month')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="year" class="form-label required">Tahun</label>
                        <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                            @foreach (range(date('Y') - 5, date('Y')) as $y)
                                <option value="{{ $y }}" @selected(old('year', date('Y')) == $y)>{{ $y }}</option>
                            @endforeach
                        </select>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-success me-1" onclick="submitForm('excel')">
                    <i class="bx bx-file"></i> Export Excel
                </button>
                <button type="button" class="btn btn-danger" onclick="submitForm('pdf')">
                    <i class="bx bxs-file-pdf"></i> Export PDF
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function toggleMonth() {
            if ($('#period_type').val() === 'yearly') {
                $('#month-container').hide();
                $('#month').removeAttr('required');
            } else {
                $('#month-container').show();
                $('#month').attr('required', 'required');
            }
        }

        $('#period_type').change(toggleMonth);
        toggleMonth();

        function submitForm(type) {
            const form = document.getElementById('report-form');
            if (!$(form).parsley().validate()) {
                return;
            }

            if (type === 'excel') {
                form.action = "{{ route('report.export_excel') }}";
            } else {
                form.action = "{{ route('report.export_pdf') }}";
            }
            form.submit();
        }
    </script>
    @endpush
</x-app>
