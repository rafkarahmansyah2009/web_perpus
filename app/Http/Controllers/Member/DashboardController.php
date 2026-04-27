<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['dipinjam', 'terlambat', 'pending'])
            ->latest()
            ->get();

        $overdueLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'terlambat')
            ->get();

        $dueSoon = Loan::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->whereBetween('tgl_kembali_rencana', [now(), now()->addDays(3)])
            ->get();

        $totalBorrowed = Loan::where('user_id', $user->id)->count();
        $currentlyBorrowed = Loan::where('user_id', $user->id)->whereIn('status', ['dipinjam', 'terlambat'])->count();

        // Greeting based on time
        $hour = now()->hour;
        if ($hour < 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        return view('member.dashboard.index', compact(
            'user', 'activeLoans', 'overdueLoans', 'dueSoon',
            'totalBorrowed', 'currentlyBorrowed', 'greeting'
        ));
    }
}
