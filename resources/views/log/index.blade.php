<form action="simpan_pelanggan.php" method="post">
    <label>ID Pelanggan:</label>
    <input type="text" name="id_pelanggan" required><br>

    <label>Nama Pelanggan:</label>
    <input type="text" name="nm_pelanggan" required><br>

    <label>Alamat:</label>
    <input type="text" name="alamat"><br>

    <label>Telepon:</label>
    <input type="text" name="telepon"><br>

    <label>Email:</label>
    <input type="email" name="email"><br>
    
    <button type="submit">Simpan</button>
</form>


@extends('layouts.app')

@section('title', 'Data Log Activity')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Activity</h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-siswa">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Log</th>
                                <th>Deskripsi</th>
                                <th>Tipe Subjek</th>
                                <th>Event</th>
                                <th>ID Subjek</th>
                                <th>Causer Type</th>
                                <th>ID Causer</th>
                                <th>Properti</th>
                                <th>Batch UUID</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($logactivity as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->log_name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->subject_type }}</td>
                                <td>{{ $item->event }}</td>
                                <td>{{ $item->subject_id }}</td>
                                <td>{{ $item->causer_type }}</td>
                                <td>{{ $item->causer_id }}</td>
                                <td>{{ $item->properties }}</td>
                                <td>{{ $item->batch_uuid }}</td>
                                <td>
</form>

                                        <a href="" class="btn btn-primary btn-sm" title="Detail">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- Bootstrap & DataTables -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table-siswa').DataTable();
    });

    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus data ini?");
    }
</script>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}
</div>
@endif
@endpush