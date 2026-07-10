<!DOCTYPE html>
<html>
<head>
    <title>Laporan Periodik - {{ $role }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2>Laporan {{ $periodType == 'monthly' ? 'Bulanan' : 'Tahunan' }}</h2>
    <h3>Periode: {{ $periodType == 'monthly' ? \Carbon\Carbon::create()->month($month)->translatedFormat('F') . ' ' . $year : $year }}</h3>
    <h3>Role: {{ $role }}</h3>

    @if(isset($data['farms']) && count($data['farms']) > 0)
        <h4>Data Lahan</h4>
        <table>
            <tr><th>ID</th><th>Nama Lahan</th><th>Pemilik</th><th>Lokasi</th><th>Luas (ha)</th></tr>
            @foreach($data['farms'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->user->name ?? '-' }}</td>
                <td>{{ $row->location }}</td>
                <td>{{ $row->area }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['buyers']) && count($data['buyers']) > 0)
        <h4>Data Pembeli</h4>
        <table>
            <tr><th>ID</th><th>Nama</th><th>Kontak</th><th>Alamat</th><th>Tipe</th></tr>
            @foreach($data['buyers'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->contact }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->type }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['sales_transactions']) && count($data['sales_transactions']) > 0)
        <h4>Transaksi Penjualan</h4>
        <table>
            <tr><th>ID</th><th>Pembeli</th><th>Tanaman</th><th>Tanggal</th><th>Kuantitas</th><th>Harga</th><th>Total</th></tr>
            @foreach($data['sales_transactions'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->buyer->name ?? '-' }}</td>
                <td>{{ $row->crop->name ?? '-' }}</td>
                <td>{{ $row->transaction_date }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ number_format($row->price, 2) }}</td>
                <td>{{ number_format($row->total, 2) }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['crops']) && count($data['crops']) > 0)
        <h4>Manajemen Tanaman</h4>
        <table>
            <tr><th>ID</th><th>Lahan</th><th>Kategori</th><th>Nama</th><th>Tanggal Tanam</th></tr>
            @foreach($data['crops'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->farm->name ?? '-' }}</td>
                <td>{{ $row->cropType->name ?? '-' }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->planting_date }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['planting_schedules']) && count($data['planting_schedules']) > 0)
        <h4>Jadwal Tanam</h4>
        <table>
            <tr><th>ID</th><th>Tanaman</th><th>Tanggal Tanam</th><th>Estimasi Panen</th></tr>
            @foreach($data['planting_schedules'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->crop->name ?? '-' }}</td>
                <td>{{ $row->plant_date }}</td>
                <td>{{ $row->estimated_harvest_date }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['harvest_records']) && count($data['harvest_records']) > 0)
        <h4>Catatan Panen</h4>
        <table>
            <tr><th>ID</th><th>Tanaman</th><th>Kuantitas</th><th>Tanggal Panen</th></tr>
            @foreach($data['harvest_records'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->crop->name ?? '-' }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->harvest_date }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['fertilizers']) && count($data['fertilizers']) > 0)
        <h4>Penggunaan Pupuk</h4>
        <table>
            <tr><th>ID</th><th>Lahan</th><th>Nama Pupuk</th><th>Kuantitas</th><th>Tanggal Aplikasi</th></tr>
            @foreach($data['fertilizers'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->farm->name ?? '-' }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->application_date }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(isset($data['pesticides']) && count($data['pesticides']) > 0)
        <h4>Penggunaan Pestisida</h4>
        <table>
            <tr><th>ID</th><th>Lahan</th><th>Nama Pestisida</th><th>Kuantitas</th><th>Tanggal Aplikasi</th></tr>
            @foreach($data['pesticides'] as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->farm->name ?? '-' }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->application_date }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    @if(empty($data))
        <p style="text-align:center;">Tidak ada data laporan untuk periode dan role ini.</p>
    @endif

</body>
</html>
