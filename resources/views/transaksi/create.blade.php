@extends('layouts.h_transaksi')

@section('title', 'Transaksi')

@section('content')

{{-- ======== FORM KASIR & PELANGGAN ======== --}}
<form action="{{ route('transaksi.store') }}" method="POST" id="cart-form">
@csrf
<div class="actor-form mb-4 p-3" style="background:#f8f9fa; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
    <div class="row g-3">
        {{-- Kasir --}}
        <div class="col-md-6">
            <label class="form-label fw-bold">Kasir</label>
            <input type="text" class="form-control" value="{{ $karyawan->name }}" readonly>
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
        </div>

        {{-- Pelanggan --}}
        <div class="col-md-6">
            <label class="form-label fw-bold">Pelanggan</label>
            <select name="pelanggan_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

{{-- ======== CARD PRODUK ======== --}}
<div class="products mb-4">
    <div class="row g-3">
        @foreach($produk as $b)
        <div class="col-md-3">
            <div class="product-card text-center p-2 border rounded shadow-sm">
                <img src="{{ asset('images/'.$b->gambar) }}" 
                     alt="{{ $b->nama_produk }}" 
                     class="img-fluid rounded mb-2" 
                     style="height:150px; object-fit:cover;">
                <h6>{{ $b->nama_produk }}</h6>
                <p class="mb-1">Rp {{ number_format($b->harga,0,',','.') }}</p>
                <button type="button" 
                        class="btn btn-success btn-sm add-to-cart" 
                        data-id="{{ $b->id }}" 
                        data-nama="{{ $b->nama_produk }}" 
                        data-harga="{{ $b->harga }}"
                        data-gambar="{{ $b->gambar }}">
                    +
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ======== KERANJANG ======== --}}
<div class="cart mt-4">
    <h6>Keranjang</h6>
    <div id="cart-items"></div>
    <hr>
    <div class="d-flex justify-content-between">
        <strong>Total:</strong>
        <span id="cart-total">Rp 0</span>
    </div>

    {{-- Input hidden keranjang akan disuntik lewat JS --}}
    <div id="cart-hidden-inputs"></div>

    <button type="submit" class="btn btn-warning w-100 mt-2">Pesan Sekarang</button>
    <button type="button" class="btn btn-light w-100 mt-2" onclick="clearCart()">Kosongkan Keranjang</button>
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
