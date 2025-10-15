@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Daftar Transaksi</h5>
    </div>
    <div class="card-body">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Tipe</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->title }}</td>
                        <td>{{ $transaction->category->name }}</td>
                        <td>{{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($transaction->type) }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus transaksi ini?');">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm">Hapus</button>
</form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
