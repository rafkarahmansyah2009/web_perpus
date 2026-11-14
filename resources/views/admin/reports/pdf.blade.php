<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman - Perpustakaan SMKN 5 Tangerang</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h1 { text-align: center; font-size: 18px; margin-bottom: 5px; }
        h2 { text-align: center; font-size: 14px; color: #666; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f5f5f5; font-weight: bold; }
        .footer { margin-top: 30px; text-align: center; color: #999; font-size: 10px; }
    </style>
</head>
<body>
    <h1>Laporan Peminjaman Buku</h1>
    <h2>Perpustakaan SMKN 5 Tangerang</h2>
    <p>Tanggal cetak: {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali Rencana</th>
                <th>Tgl Kembali Aktual</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $i => $loan)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $loan->user?->name ?? 'User Terhapus' }}</td>
                <td>{{ $loan->book?->judul ?? 'Buku Terhapus' }}</td>
                <td>{{ $loan->tgl_pinjam?->format('d/m/Y') }}</td>
                <td>{{ $loan->tgl_kembali_rencana?->format('d/m/Y') }}</td>
                <td>{{ $loan->tgl_kembali_aktual?->format('d/m/Y') ?? '-' }}</td>
                <td>{{ ucfirst($loan->status) }}</td>
                <td>{{ $loan->fine ? 'Rp '.number_format($loan->fine->nominal_denda,0,',','.') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Perpustakaan SMKN 5 Tangerang
    </div>
</body>
</html>
