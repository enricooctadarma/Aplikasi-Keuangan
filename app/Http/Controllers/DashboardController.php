<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan filter dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $categoryId = $request->input('category_id');
    
        // Query transaksi dengan filter
        $transactionsQuery = Transaction::query();
    
        if ($startDate) {
            $transactionsQuery->where('date', '>=', $startDate);
        }
    
        if ($endDate) {
            $transactionsQuery->where('date', '<=', $endDate);
        }
    
        if ($categoryId) {
            $transactionsQuery->where('category_id', $categoryId);
        }
    
        $transactions = $transactionsQuery->get();
    
        // Menghitung total pemasukan, pengeluaran, dan saldo berdasarkan filter
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;
    
        // Riwayat transaksi terbaru (berdasarkan filter)
        $latestTransactions = $transactions->sortByDesc('date')->take(5);
    
        // Semua kategori untuk dropdown filter
        $categories = \App\Models\Category::all();
    
        return view('dashboard.index', compact(
            'totalIncome', 'totalExpense', 'totalBalance', 'latestTransactions', 'categories', 'startDate', 'endDate', 'categoryId'
        ));
    }
}
