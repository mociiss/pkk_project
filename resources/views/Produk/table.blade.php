<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Gambar</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produk as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->nama_produk }}</td>
            <td>
                @if($p->gambar)
                    <img src="{{ asset('images/' . $p->gambar) }}" alt="Gambar Barang" width="50">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
            </td>
            <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
            <td>{{ $p->stok }}</td>
            <td>
                <a href="{{ route('produk.edit', $p->id) }}" class="btn-edit">Edit</a>
                <form action="{{ route('produk.destroy', $p->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted">Tidak ada data produk.</td>
        </tr>
        @endforelse
    </tbody>
</table>
