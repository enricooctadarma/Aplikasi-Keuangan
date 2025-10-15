@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Laporan Keuangan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('reports.index') }}" method="GET" class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="form-control" 
                       value="{{ $startDate ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="form-control" 
                       value="{{ $endDate ?? '' }}">
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Terapkan</button>
            </div>
        </form>

        <div class="mt-3">
            <a href="{{ route('reports.export.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="btn btn-danger">Ekspor PDF</a>
            <a href="{{ route('reports.export.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="btn btn-success">Ekspor Excel</a>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">Daftar Transaksi</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->category->name }}</td>
                    <td>{{ $transaction->title }}</td>
                    <td>{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
