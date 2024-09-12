@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient text-white" style="background-color: #fc6a3e;">
                    <h4 class="mb-0 text-center">Edit Pegawai</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="form-group mb-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="nama" name="nama" value="{{ $pegawai->nama }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email" name="email" value="{{ $pegawai->email }}" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="form-group mb-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control form-control-lg shadow-sm datepicker" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pegawai->tanggal_lahir }}" required>
                        </div>

                        <!-- Jabatan -->
                        <div class="form-group mb-4">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" id="jabatan" name="jabatan" value="{{ $pegawai->jabatan }}" required>
                        </div>

                        <!-- Upload File -->
                        <div class="form-group mb-4">
                            <label for="file" class="form-label">Upload File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Pilih file</label>
                            </div>
                            @if($pegawai->file)
                                <small class="form-text text-muted mt-2">File saat ini: <a href="{{ asset('storage/' . $pegawai->file) }}" target="_blank">Download File</a></small>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm px-4" style="background-color:#fc6a3e;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('pegawai.index') }}" class="btn btn-lg btn-secondary shadow-sm px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk DatePicker dan FileInput -->
<script>
    $(document).ready(function () {
        // Date Picker
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },
            opens: 'left',
            drops: 'up',
            buttonClasses: 'btn btn-primary'
        });

        // File Input Bootstrap Custom
        bsCustomFileInput.init();

        // Memperbarui label custom file input dengan nama file yang dipilih
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
@endsection
