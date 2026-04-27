<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book', 'fine']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        // Auto-mark overdue loans
        Loan::where('status', 'dipinjam')
            ->where('tgl_kembali_rencana', '<', now())
            ->update(['status' => 'terlambat']);

        $loans = $query->latest()->paginate(10);

        return view('admin.loans.index', compact('loans'));
    }

    public function show($id)
    {
        $loan = Loan::with(['user', 'book', 'fine'])->findOrFail($id);
        return view('admin.loans.show', compact('loan'));
    }

    public function konfirmasi($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status pending.');
        }

        $loan->update([
            'status' => 'dipinjam',
            'tgl_pinjam' => now(),
            'tgl_kembali_rencana' => now()->addDays(7),
        ]);

        return back()->with('success', 'Peminjaman berhasil dikonfirmasi.');
    }

    public function kembalikan($id)
    {
        $loan = Loan::findOrFail($id);

        if (!in_array($loan->status, ['dipinjam', 'terlambat'])) {
            return back()->with('error', 'Status peminjaman tidak valid untuk pengembalian.');
        }

        $today = Carbon::now();
        $loan->update([
            'status' => 'dikembalikan',
            'tgl_kembali_aktual' => $today,
        ]);

        // Calculate fine if late
        if ($today->gt($loan->tgl_kembali_rencana)) {
            $daysLate = $today->diffInDays($loan->tgl_kembali_rencana);
            Fine::create([
                'loan_id' => $loan->id,
                'jumlah_hari' => $daysLate,
                'nominal_denda' => $daysLate * 1000,
                'status_bayar' => 'belum',
            ]);
        }

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
