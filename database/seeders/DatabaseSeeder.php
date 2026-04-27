<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === USERS ===
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@smkn5tng.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_aktif' => true,
        ]);

        User::create([
            'name' => 'Fitri Indah Wulandari, S.Kom',
            'email' => 'fitri.wulandari@smkn5tng.sch.id',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
            'nip' => '198907122010011005',
            'no_telp' => '081234567890',
            'status_aktif' => true,
        ]);

        User::create([
            'name' => 'Dr. Ir. Mahpud, M.Kom',
            'email' => 'mahpud@smkn5tng.sch.id',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
            'nip' => '199003152012012003',
            'no_telp' => '081298765432',
            'status_aktif' => true,
        ]);

        $siswaData = [
            ['name' => 'Kayla Sanari Rubina', 'email' => 'kayla.rubina@smkn5tng.sch.id', 'nis' => '20240001', 'kelas' => 'XI RPL 1'],
            ['name' => 'Kasandra Aulea', 'email' => 'kasandra.aulea@smkn5tng.sch.id', 'nis' => '20240002', 'kelas' => 'XI RPL 1'],
            ['name' => 'Tobias Ibrahim', 'email' => 'tobias.ibrahim@smkn5tng.sch.id', 'nis' => '20240003', 'kelas' => 'XI RPL 1'],
            ['name' => 'Rafka Rahmansyah', 'email' => 'rafka.rahmansyah@smkn5tng.sch.id', 'nis' => '20240004', 'kelas' => 'XI RPL 1'],
            ['name' => 'Dzikri Nabil Budiharja', 'email' => 'dzikri.budiharja@smkn5tng.sch.id', 'nis' => '20240005', 'kelas' => 'X RPL 1'],
        ];

        foreach ($siswaData as $siswa) {
            User::create(array_merge($siswa, [
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'status_aktif' => true,
            ]));
        }

        // === CATEGORIES ===
        $categories = [
            ['nama' => 'Fiksi', 'slug' => 'fiksi', 'deskripsi' => 'Buku-buku karya fiksi seperti novel, cerpen, dan puisi'],
            ['nama' => 'Pelajaran', 'slug' => 'pelajaran', 'deskripsi' => 'Buku pelajaran sekolah dan buku teks akademik'],
            ['nama' => 'Referensi', 'slug' => 'referensi', 'deskripsi' => 'Buku referensi umum seperti ensiklopedia dan kamus'],
            ['nama' => 'Sains', 'slug' => 'sains', 'deskripsi' => 'Buku-buku ilmu pengetahuan alam dan teknologi'],
            ['nama' => 'Sejarah', 'slug' => 'sejarah', 'deskripsi' => 'Buku-buku sejarah Indonesia dan dunia'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // === BOOKS ===
        $books = [
            [
                'isbn' => '978-602-06-5362-6',
                'judul' => 'Laskar Pelangi',
                'pengarang' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori_id' => 1,
                'deskripsi' => 'Novel yang menceritakan kisah inspiratif 10 anak dari Belitung yang berjuang meraih pendidikan.',
                'stok' => 5,
                'lokasi_rak' => 'A-01',
            ],
            [
                'isbn' => '978-602-291-173-7',
                'judul' => 'Bumi Manusia',
                'pengarang' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => 1980,
                'kategori_id' => 1,
                'deskripsi' => 'Novel pertama dari Tetralogi Buru yang berlatarkan masa kolonial Hindia Belanda.',
                'stok' => 3,
                'lokasi_rak' => 'A-02',
            ],
            [
                'isbn' => '978-602-244-453-0',
                'judul' => 'Matematika Kelas XII',
                'pengarang' => 'Kemendikbud',
                'penerbit' => 'Pusat Kurikulum',
                'tahun_terbit' => 2023,
                'kategori_id' => 2,
                'deskripsi' => 'Buku teks matematika untuk SMA/SMK kelas XII kurikulum merdeka.',
                'stok' => 10,
                'lokasi_rak' => 'B-01',
            ],
            [
                'isbn' => '978-602-244-454-7',
                'judul' => 'Bahasa Indonesia Kelas XI',
                'pengarang' => 'Kemendikbud',
                'penerbit' => 'Pusat Kurikulum',
                'tahun_terbit' => 2023,
                'kategori_id' => 2,
                'deskripsi' => 'Buku teks Bahasa Indonesia untuk SMA/SMK kelas XI kurikulum merdeka.',
                'stok' => 8,
                'lokasi_rak' => 'B-02',
            ],
            [
                'isbn' => '978-979-22-4631-0',
                'judul' => 'Ensiklopedia Indonesia',
                'pengarang' => 'Tim Penyusun',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2018,
                'kategori_id' => 3,
                'deskripsi' => 'Ensiklopedia komprehensif tentang Indonesia meliputi budaya, geografi, dan sejarah.',
                'stok' => 2,
                'lokasi_rak' => 'C-01',
            ],
            [
                'isbn' => '978-602-03-3662-5',
                'judul' => 'Kamus Besar Bahasa Indonesia',
                'pengarang' => 'Badan Bahasa',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2020,
                'kategori_id' => 3,
                'deskripsi' => 'Kamus resmi Bahasa Indonesia edisi kelima.',
                'stok' => 4,
                'lokasi_rak' => 'C-02',
            ],
            [
                'isbn' => '978-602-06-2345-1',
                'judul' => 'Fisika Modern',
                'pengarang' => 'Halliday & Resnick',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2019,
                'kategori_id' => 4,
                'deskripsi' => 'Buku teks fisika modern yang membahas mekanika kuantum dan relativitas.',
                'stok' => 6,
                'lokasi_rak' => 'D-01',
            ],
            [
                'isbn' => '978-602-06-2346-8',
                'judul' => 'Biologi Molekuler',
                'pengarang' => 'Bruce Alberts',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2021,
                'kategori_id' => 4,
                'deskripsi' => 'Panduan lengkap biologi molekuler dan genetika.',
                'stok' => 3,
                'lokasi_rak' => 'D-02',
            ],
            [
                'isbn' => '978-979-22-1234-5',
                'judul' => 'Sejarah Indonesia Modern',
                'pengarang' => 'M.C. Ricklefs',
                'penerbit' => 'Serambi',
                'tahun_terbit' => 2016,
                'kategori_id' => 5,
                'deskripsi' => 'Sejarah Indonesia dari abad ke-13 hingga era reformasi.',
                'stok' => 4,
                'lokasi_rak' => 'E-01',
            ],
            [
                'isbn' => '978-979-22-1235-2',
                'judul' => 'Perang Dunia II',
                'pengarang' => 'Winston Churchill',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2017,
                'kategori_id' => 5,
                'deskripsi' => 'Kronik lengkap Perang Dunia Kedua dari perspektif global.',
                'stok' => 3,
                'lokasi_rak' => 'E-02',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // === ANNOUNCEMENTS ===
        Announcement::create([
            'judul' => 'Selamat Datang di Portal Perpustakaan Digital',
            'slug' => 'selamat-datang-portal-perpustakaan-digital',
            'konten' => '<p>Dengan bangga kami memperkenalkan Portal Perpustakaan Digital SMKN 5 Tangerang. Portal ini memudahkan siswa dan guru untuk mengakses katalog buku, melakukan peminjaman secara online, dan mendapatkan informasi terkini dari perpustakaan.</p><p>Fitur-fitur unggulan:</p><ul><li>Katalog buku digital dengan pencarian cepat</li><li>Peminjaman buku online</li><li>Notifikasi jatuh tempo</li><li>Riwayat peminjaman lengkap</li></ul>',
            'status' => 'publish',
            'tgl_publish' => now()->subDays(5),
        ]);

        Announcement::create([
            'judul' => 'Jadwal Operasional Perpustakaan Semester Genap',
            'slug' => 'jadwal-operasional-perpustakaan-semester-genap',
            'konten' => '<p>Perpustakaan SMKN 5 Tangerang beroperasi pada jam berikut di semester genap tahun ajaran 2024/2025:</p><ul><li>Senin - Kamis: 07.00 - 15.00 WIB</li><li>Jumat: 07.00 - 11.30 WIB</li><li>Sabtu - Minggu: Tutup</li></ul><p>Peminjaman buku maksimal 7 hari. Perpanjangan dapat dilakukan 1x melalui portal online.</p>',
            'status' => 'publish',
            'tgl_publish' => now()->subDays(3),
        ]);

        Announcement::create([
            'judul' => 'Koleksi Buku Baru Bulan April 2025',
            'slug' => 'koleksi-buku-baru-bulan-april-2025',
            'konten' => '<p>Perpustakaan telah menambahkan 50 judul buku baru di bulan April 2025. Koleksi baru mencakup kategori:</p><ul><li>Novel fiksi terbaru karya penulis Indonesia</li><li>Buku pelajaran kurikulum merdeka terbaru</li><li>Buku referensi teknologi informasi</li><li>Ensiklopedia sains terbaru</li></ul><p>Segera kunjungi perpustakaan atau cek katalog online untuk informasi lengkap!</p>',
            'status' => 'publish',
            'tgl_publish' => now()->subDay(),
        ]);
    }
}
