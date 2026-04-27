<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index(Request $request)
    {
        $query = Fine::with(['loan.user', 'loan.book']);

        if ($request->filled('status')) {
            $query->where('status_bayar', $request->status);
        }

        $fines = $query->latest()->paginate(10);
        $totalUnpaid = Fine::where('status_bayar', 'belum')->sum('nominal_denda');

        return view('admin.fines.index', compact('fines', 'totalUnpaid'));
    }

    public function lunas($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->update([
            'status_bayar' => 'lunas',
            'tgl_bayar' => now(),
        ]);

        return back()->with('success', 'Denda berhasil dikonfirmasi lunas.');
    }
}
