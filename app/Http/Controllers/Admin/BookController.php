<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
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
            $query->where('kategori_id', $request->kategori);
        }

        $books = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(BookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $buku)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('buku', 'categories'));
    }

    public function update(BookRequest $request, Book $buku)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $buku)
    {
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        // Simple CSV/Excel import without Maatwebsite package
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if ($extension === 'csv') {
            $handle = fopen($file->getPathname(), 'r');
            $header = fgetcsv($handle);
            $imported = 0;

            while ($row = fgetcsv($handle)) {
                $data = array_combine($header, $row);
                Book::create([
                    'isbn' => $data['isbn'] ?? null,
                    'judul' => $data['judul'],
                    'pengarang' => $data['pengarang'],
                    'penerbit' => $data['penerbit'] ?? null,
                    'tahun_terbit' => $data['tahun_terbit'] ?? null,
                    'kategori_id' => $data['kategori_id'] ?? 1,
                    'deskripsi' => $data['deskripsi'] ?? null,
                    'stok' => $data['stok'] ?? 1,
                    'lokasi_rak' => $data['lokasi_rak'] ?? null,
                ]);
                $imported++;
            }
            fclose($handle);

            return redirect()->route('admin.buku.index')->with('success', "{$imported} buku berhasil diimport.");
        }

        return redirect()->route('admin.buku.index')->with('error', 'Format file tidak didukung. Gunakan CSV.');
    }
}
