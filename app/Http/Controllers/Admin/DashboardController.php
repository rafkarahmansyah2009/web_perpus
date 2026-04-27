<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stok');
        $activeMembers = User::where('role', '!=', 'admin')->where('status_aktif', true)->count();
        $currentlyBorrowed = Loan::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $unpaidFines = Fine::where('status_bayar', 'belum')->sum('nominal_denda');

        // Chart data - loans per month (last 6 months)
        $loanChartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Loan::whereYear('tgl_pinjam', $date->year)
                         ->whereMonth('tgl_pinjam', $date->month)
                         ->count();
            $loanChartData[] = [
                'month' => $date->translatedFormat('M Y'),
                'count' => $count,
            ];
        }

        // Category distribution
        $categoryData = Category::withCount('books')->get()->map(function ($cat) {
            return ['name' => $cat->nama, 'count' => $cat->books_count];
        });

        // Recent transactions
        $recentLoans = Loan::with(['user', 'book'])->latest()->take(5)->get();

        // Books due soon
        $dueSoon = Loan::with(['user', 'book'])
                       ->where('status', 'dipinjam')
                       ->whereBetween('tgl_kembali_rencana', [now(), now()->addDays(3)])
                       ->orderBy('tgl_kembali_rencana')
                       ->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalBooks', 'activeMembers', 'currentlyBorrowed', 'unpaidFines',
            'loanChartData', 'categoryData', 'recentLoans', 'dueSoon'
        ));
    }
}
