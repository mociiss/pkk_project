<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Struk Thermal</title> 
    <style> 
        body { font-family: monospace, sans-serif; font-size: 10px; } 
        .center { text-align: center; } 
        table { width: 100%; border-collapse: collapse; } 
        td, th { padding: 2px 0; } 
        .total { border-top: 1px dashed #000; font-weight: bold; } 
        .line { border-top: 1px dashed #000; margin: 5px 0; } 
    </style> 
</head> 
<body> 
    <div class="center"> 
        <h3>CatatYuk</h3> 
        <p>Meryta Cookies</p> 
        <p>Tanggal: {{ $transaksi->tanggal }}</p>
        <div class="line"></div> 
    </div> 
 
    <table> 
        @foreach($transaksi->detail as $d) 
        <tr> 
            <td colspan="3">{{ $d->produk->nama_produk }}</td> 
        </tr> 
        <tr> 
            <td>{{ $d->jumlah }} x</td> 
            <td>Rp {{ number_format($d->harga,0,',','.') }}</td> 
            <td style="text-align:right;">Rp {{ number_format($d->subtotal,0,',','.') }}</td> 
        </tr> 
        @endforeach 
        <tr class="total"> 
            <td colspan="2">TOTAL</td>
            <td style="text-align:right;">Rp {{ number_format($transaksi->total,0,',','.') }}</td> 
</tr> 
</table> 
<div class="line"></div> 
<div class="center"> 
<p>Terima Kasih :)</p> 
<p>Barang yang sudah dibeli tidak dapat dikembalikan</p> 
</div> 
</body> 
</html>