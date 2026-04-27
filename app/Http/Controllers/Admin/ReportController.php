<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book', 'fine']);

        if ($request->filled('dari')) {
            $query->whereDate('tgl_pinjam', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tgl_pinjam', '<=', $request->sampai);
        }

        $loans = $query->latest()->paginate(15);

        return view('admin.reports.index', compact('loans'));
    }

    public function exportPdf(Request $request)
    {
        $query = Loan::with(['user', 'book', 'fine']);

        if ($request->filled('dari')) {
            $query->whereDate('tgl_pinjam', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tgl_pinjam', '<=', $request->sampai);
        }

        $loans = $query->latest()->get();

        // Generate simple HTML-to-PDF response
        $html = view('admin.reports.pdf', compact('loans'))->render();

        return response($html)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="laporan-peminjaman.html"');
    }

    public function exportExcel(Request $request)
    {
        $query = Loan::with(['user', 'book', 'fine']);

        if ($request->filled('dari')) {
            $query->whereDate('tgl_pinjam', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tgl_pinjam', '<=', $request->sampai);
        }

        $loans = $query->latest()->get();

        $csvContent = "No,Nama Anggota,Judul Buku,Tgl Pinjam,Tgl Kembali Rencana,Tgl Kembali Aktual,Status,Denda\n";

        foreach ($loans as $i => $loan) {
            $csvContent .= implode(',', [
                $i + 1,
                '"' . $loan->user->name . '"',
                '"' . $loan->book->judul . '"',
                $loan->tgl_pinjam?->format('d/m/Y') ?? '-',
                $loan->tgl_kembali_rencana?->format('d/m/Y') ?? '-',
                $loan->tgl_kembali_aktual?->format('d/m/Y') ?? '-',
                $loan->status,
                $loan->fine ? 'Rp ' . number_format($loan->fine->nominal_denda, 0, ',', '.') : '-',
            ]) . "\n";
        }

        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="laporan-peminjaman.csv"');
    }
}
