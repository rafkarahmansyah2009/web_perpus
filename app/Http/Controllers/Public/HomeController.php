<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Book;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stok');
        $totalMembers = User::where('role', '!=', 'admin')->where('status_aktif', true)->count();
        $availableToday = Book::all()->filter(fn($book) => $book->tersedia())->count();
        $latestBooks = Book::with('kategori')->latest()->take(8)->get();
        $announcements = Announcement::published()->latest('tgl_publish')->take(3)->get();

        return view('public.home.index', compact(
            'totalBooks', 'totalMembers', 'availableToday', 'latestBooks', 'announcements'
        ));
    }
}
