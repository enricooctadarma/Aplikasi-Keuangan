<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Keuangan</h2>
    <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Tipe</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->title }}</td>
                    <td>{{ $transaction->category->name ?? '-' }}</td>
                    <td>Rp {{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
        