@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0" style="color: black;">Data Pegawai</h5>
        <h5 class="h4 mb-0 text-gray-800">Master / Data Pegawai</h5>
    </div>

    <hr>

    <!-- Filter Data Pegawai -->
    <div class="mb-4 d-flex flex-wrap align-items-center">
        <select id="pegawaiFilter" class="form-control mr-2 mb-2" style="flex: 1;">
            <option value="">Pilih Pegawai</option>
            @foreach ($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
            @endforeach
        </select>
        <input type="text" id="emailFilter" class="form-control mr-2 mb-2" placeholder="Filter Email" style="flex: 1;">
        <input type="date" id="tanggalLahirFilter" class="form-control mr-2 mb-2" placeholder="Filter Tanggal Lahir" style="flex: 1;">
        <input type="text" id="jabatanFilter" class="form-control mb-2" placeholder="Filter Jabatan" style="flex: 1;">
        <button id="filterButton" class="btn btn-primary ml-2" style="background-color: #808080; color: white;">Filter</button>
    </div>

    <!-- Tabel Data Pegawai -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Data Pegawai</h6>
            <a href="{{ route('pegawai.create') }}" class="btn" style="background-color: #fc6a3e; color: white;">Tambah Pegawai</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pegawaiTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $pegawai)
                            <tr data-pegawai-id="{{ $pegawai->id }}" data-email="{{ $pegawai->email }}" data-tanggal-lahir="{{ $pegawai->tanggal_lahir }}" data-jabatan="{{ $pegawai->jabatan }}">
                                <td>{{ $pegawai->nama }}</td>
                                <td>{{ $pegawai->email }}</td>
                                <td>{{ $pegawai->tanggal_lahir }}</td>
                                <td>{{ $pegawai->jabatan }}</td>
                                <td>
                                    <a href="{{ route('pegawai.show', $pegawai) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('pegawai.edit', $pegawai) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pegawai.destroy', $pegawai) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#pegawaiTable').DataTable();

            $('#pegawaiFilter').select2();

            $('#filterButton').on('click', function () {
                fetchFilteredData();
            });

            function fetchFilteredData() {
                $.ajax({
                    url: '{{ route('pegawai.index') }}',
                    method: 'GET',
                    data: {
                        pegawai_id: $('#pegawaiFilter').val(),
                        email: $('#emailFilter').val(),
                        tanggal_lahir: $('#tanggalLahirFilter').val(),
                        jabatan: $('#jabatanFilter').val()
                    },
                    success: function(data) {
                        table.clear().rows.add(data).draw();
                    }
                });
            }
        });
    </script>

    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/css/select2.min.css" rel="stylesheet" />
@endsection
