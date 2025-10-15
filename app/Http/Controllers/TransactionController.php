<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with('category')->get();
        return view('transactions.index', compact('transactions'));
    }

    // Menampilkan form untuk menambahkan transaksi baru
    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit(Transaction $transaction)
{
    $categories = Category::all();
    return view('transactions.edit', compact('transaction', 'categories'));
}

    // Memperbarui transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    // Menghapus transaksi
public function destroy(Transaction $transaction)
{
    $transaction->delete();
    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
}
}
