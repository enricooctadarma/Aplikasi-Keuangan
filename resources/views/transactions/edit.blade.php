@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Transaksi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $transaction->title }}" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ $transaction->amount }}" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipe</label>
                <select name="type" id="type" class="form-control">
                    <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $transaction->date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
