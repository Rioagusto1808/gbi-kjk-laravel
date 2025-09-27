<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">Laporan Keuangan GBI KJK</h2>
    <p><strong>Tanggal Cetak:</strong> {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $total = 0;
            @endphp
            @foreach ($trx as $t)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $t->tipe }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $t->keterangan }}</td>
                    <td>{{ $t->dibuatOleh?->name }}</td>
                </tr>
                @php $total += $t->jumlah; @endphp
            @endforeach
            <tr>
                <th colspan="4">Total</th>
                <th colspan="3">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>
</body>

</html>
