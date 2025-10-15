@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Informasi Pengguna -->
    <div class="col-12 mb-3">
        <div class="alert alert-info">
            Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
        </div>
    </div>
    
    <!-- Total Pemasukan -->
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Pemasukan</h5>
                <p class="card-text">Rp {{ number_format($totalIncome, 2) }}</p>
            </div>
        </div>
    </div>
    <!-- Total Pengeluaran -->
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Pengeluaran</h5>
                <p class="card-text">Rp {{ number_format($totalExpense, 2) }}</p>
            </div>
        </div>
    </div>
    <!-- Total Saldo -->
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Saldo</h5>
                <p class="card-text">Rp {{ number_format($totalBalance, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Form Filter -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Filter Transaksi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Riwayat Transaksi -->
<div class="card">
    <div class="card-header">
        <h5>Riwayat Transaksi Terbaru</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
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
                @forelse($latestTransactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->title }}</td>
                        <td>{{ $transaction->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($transaction->type) }}</td>
                        <td>{{ $transaction->date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
