<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;



class ReportController extends Controller
{
    public function index(Request $request)
{
    $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
    $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());

    // Ambil transaksi berdasarkan tanggal
    $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->orderBy('date', 'asc')->get();

    return view('reports.index', compact('transactions', 'startDate', 'endDate'));
}

    public function generate(Request $request)
    {
        $type = $request->input('type'); // weekly or monthly
        $startDate = null;
        $endDate = null;

        if ($type == 'weekly') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } elseif ($type == 'monthly') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }

        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();
        return view('reports.generate', compact('transactions', 'type', 'startDate', 'endDate'));
    }

    public function exportPDF(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

    $pdf = Pdf::loadView('reports.pdf', compact('transactions', 'startDate', 'endDate'));
    return $pdf->download("laporan-{$startDate}-{$endDate}.pdf");
}

public function exportExcel(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    return Excel::download(new TransactionsExport($transactions), "laporan-{$startDate}-{$endDate}.xlsx");
}
}
