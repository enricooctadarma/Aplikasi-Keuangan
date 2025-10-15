@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Transaksi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipe</label>
                <select name="type" id="type" class="form-control">
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
