@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex justify-content-between mb-4">
            <h2 class="text-dark">Detail Pegawai</h2>
            <a href="{{ route('pegawai.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <!-- Card untuk Detail Pegawai -->
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body p-4">
                <!-- Gambar Profil -->
                <div class="text-center mb-4">
                    <img src="{{ $pegawai->foto ? asset('storage/' . $pegawai->foto) : 'https://via.placeholder.com/150' }}" class="img-fluid rounded-circle" alt="Foto Pegawai" style="width: 150px; height: 150px;">
                </div>
                <!-- Detail Pegawai -->
                <h5 class="card-title text-center mb-4">{{ $pegawai->nama }}</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="card-text"><strong>Email:</strong> {{ $pegawai->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="card-text"><strong>Tanggal Lahir:</strong> {{ $pegawai->tanggal_lahir }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="card-text"><strong>Jabatan:</strong> {{ $pegawai->jabatan }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="card-text">
                            <strong>File:</strong> 
                            @if($pegawai->file)
                                <a href="{{ asset('storage/' . $pegawai->file) }}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fas fa-download me-2"></i> Download File
                                </a>
                            @else
                                Tidak ada file
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
