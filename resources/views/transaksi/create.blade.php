@extends('layouts.h_transaksi')

@section('title', 'CatatYuk - Transaksi Baru')

@section('content')
<form action="{{ route('transaksi.store') }}" method="POST" id="cart-form">
    @csrf
    <div class="actor-form">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Kasir</label>
                <input type="text" class="form-control" value="{{ $karyawan->name }}" readonly>
                <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Pelanggan</label>
                <select name="pelanggan_id" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Pelanggan --</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="tanggal_pengiriman" class="form-label">Tanggal Pengantaran</label>
                <input type="date" name="tanggal_pengiriman" id="tanggal_pengiriman" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label for="waktu_pengiriman" class="form-label">Waktu Pengantaran</label>
                <input type="time" name="waktu_pengiriman" id="waktu_pengiriman" class="form-control" required>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <div class="main-area flex-fill">
            <div class="product-grid">
                @foreach($produk as $b)
                    <div class="product-card">
                        <img src="{{ asset('images/'.$b->gambar) }}" alt="{{ $b->nama_produk }}">
                        <h6>{{ $b->nama_produk }}</h6>
                        <p>Rp {{ number_format($b->harga, 0, ',', '.') }}</p>
                        <button type="button"
                                class="add-to-cart"
                                data-id="{{ $b->id }}"
                                data-nama="{{ $b->nama_produk }}"
                                data-harga="{{ $b->harga }}"
                                data-gambar="{{ $b->gambar }}">
                            +
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="cart">
            <h6>🛒 Keranjang</h6>
            <div id="cart-items"></div>
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total:</strong>
                <span id="cart-total">Rp 0</span>
            </div>

            <div id="cart-hidden-inputs"></div>
            <button type="submit" class="btn btn-warning w-100 mt-3">Pesan Sekarang</button>
            <button type="button" class="btn btn-light w-100 mt-2" onclick="clearCart()">Kosongkan Keranjang</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    let cart = [];

    function renderCart() {
        let cartItems = document.getElementById("cart-items");
        let hiddenInputs = document.getElementById("cart-hidden-inputs");
        let total = 0;
        cartItems.innerHTML = "";
        hiddenInputs.innerHTML = "";

        cart.forEach((item) => {
            total += item.harga * item.jumlah;

            cartItems.innerHTML += `
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('images') }}/${item.gambar}" width="50" height="50" class="me-2 rounded">
                    <div class="flex-grow-1">
                        <small>${item.nama}</small><br>
                        Rp ${item.harga.toLocaleString()}
                    </div>
                    <button type="button" class="btn-minus btn btn-sm btn-outline-danger" onclick="updateQty(${item.id}, -1)">-</button>
                    <span class="mx-2">${item.jumlah}</span>
                    <button type="button" class="btn-plus btn btn-sm btn-outline-success" onclick="updateQty(${item.id}, 1)">+</button>
                </div>
            `;

            hiddenInputs.innerHTML += `
                <input type="hidden" name="produk_id[]" value="${item.id}">
                <input type="hidden" name="jumlah[]" value="${item.jumlah}">
            `;
        });

        document.getElementById("cart-total").innerText = "Rp " + total.toLocaleString();
    }

    

    function updateQty(id, change) {
        let item = cart.find(i => i.id == id);
        if (item) {
            item.jumlah += change;
            if (item.jumlah <= 0) cart = cart.filter(i => i.id != id);
            renderCart();
        }
    }

    function clearCart() {
        cart = [];
        renderCart();
    }

    document.querySelectorAll(".add-to-cart").forEach(btn => {
        btn.addEventListener("click", function() {
            let id = this.dataset.id;
            let nama = this.dataset.nama;
            let harga = parseInt(this.dataset.harga);
            let gambar = this.dataset.gambar;

            let existing = cart.find(i => i.id == id);
            if (existing) {
                existing.jumlah++;
            } else {
                cart.push({ id:id, nama:nama, harga:harga, jumlah:1, gambar:gambar });
            }
            renderCart();
        });
    });
</script>
@endpush
