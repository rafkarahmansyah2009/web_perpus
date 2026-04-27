<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('books')->get();

        $query = Book::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->whereIn('kategori_id', (array)$request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        $books = $query->latest()->paginate(12);

        return view('public.catalog.index', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::with('kategori')->findOrFail($id);
        $relatedBooks = Book::where('kategori_id', $book->kategori_id)
                            ->where('id', '!=', $book->id)
                            ->take(4)->get();

        return view('public.catalog.show', compact('book', 'relatedBooks'));
    }
}
