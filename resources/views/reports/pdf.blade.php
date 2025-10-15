<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        /* Gaya CSS untuk PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Keuangan dari {{ $startDate }} hingga {{ $endDate }}</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
