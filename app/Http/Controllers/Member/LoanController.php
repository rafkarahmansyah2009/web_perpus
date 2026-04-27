<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'fine'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('member.loans.index', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if (!$book->tersedia()) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Check if user already has this book borrowed
        $existing = Loan::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'dipinjam'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Anda sudah meminjam atau mengajukan pinjaman buku ini.');
        }

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tgl_pinjam' => now(),
            'tgl_kembali_rencana' => now()->addDays(7),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil. Menunggu konfirmasi admin.');
    }

    public function perpanjang($id)
    {
        $loan = Loan::where('user_id', Auth::id())->findOrFail($id);

        if ($loan->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman tidak dapat diperpanjang.');
        }

        if ($loan->sudah_diperpanjang) {
            return back()->with('error', 'Peminjaman sudah pernah diperpanjang.');
        }

        $loan->update([
            'tgl_kembali_rencana' => $loan->tgl_kembali_rencana->addDays(7),
            'sudah_diperpanjang' => true,
        ]);

        return back()->with('success', 'Peminjaman berhasil diperpanjang 7 hari.');
    }
}
