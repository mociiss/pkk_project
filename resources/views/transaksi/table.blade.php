<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kasir</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Detail Barang</th>
            <th>Total</th>
            <th>Tanggal Pengiriman</th>
            <th>Status</th>
            <th>Konfirmasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transaksi as $index => $t)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $t->karyawan->nama ?? '-' }}</td>
            <td>{{ $t->pelanggan->nama ?? '-' }}</td>
            <td>{{ $t->tanggal }}</td>
            <td>
                <ul>
                    @foreach($t->detail as $td)
                        <li>
                            {{ $td->produk->nama_produk }}
                            ({{ $td->jumlah }} x Rp {{ number_format($td->harga, 0, ',', '.') }})
                            : <b>Rp {{ number_format($td->subtotal, 0, ',', '.') }}</b>
                        </li>
                    @endforeach
                </ul>
            </td>
            <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
            <td>{{ $t->tanggal_pengiriman ?? '-' }}</td>
            <td>{{ $t->status }}</td>
            <td>
                @if($t->metode_pembayaran === 'E-Wallet' && $t->status_pembayaran === 'Menunggu Konfirmasi')
                <form action="{{ route('transaksi.konfirmasi', $t->id) }}" method="POST" style="display:inline;">
                @csrf
                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi Pembayaran</button>
                </form>
                @endif
            </td>
            <td>
                <a href="{{ route('transaksi.cetak', $t->id) }}" class="btn-cetak" target="_blank"><i class="fas fa-print">Cetak Struk</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center text-muted">Tidak ada data transaksi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
