<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body { 
            font-family: sans-serif; 
            font-size: 12px; 
            color: #333; 
        }
        h2 { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }

        th, td { 
            border: 1px solid #999; 
            padding: 6px; 
            text-align: left; 
        }

        th { 
            background: #eee; 
        }
        
        .total {  
            font-weight: bold; 
            background: #f5f5f5; }

        .ringkasan { 
            margin-top: 30px; 
        }

        .ringkasan h3 { 
            margin-bottom: 8px; 
            font-size: 14px; 
        }
    </style>
</head>
<body>
    <h2>{{ $judul }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->karyawan->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $t->pelanggan->nama ?? '-' }}</td>
                <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                <td>{{ $t->status }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total">Total Penjualan Keseluruhan</td>
                <td colspan="2" class="total">Rp {{ number_format($totalSemua, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="ringkasan">
        <h3>Ringkasan Berdasarkan Status</h3>
        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Jumlah Transaksi</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ringkasan as $status => $data)
                <tr>
                    <td>{{ $status }}</td>
                    <td>{{ $data['jumlah'] }}</td>
                    <td>Rp {{ number_format($data['total'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br><br>
    <p style="text-align: right; font-size: 11px; color: #555;">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </p>
</body>
</html>
