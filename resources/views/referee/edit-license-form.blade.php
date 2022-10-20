@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <h2>Edit Lisensi Wasit</h2>
        <p>Edit data lisensi Anda sebagai wasit basket pada form ini.</p>
        @include('partials.alert')
        <form action="{{ route('referee.editLicense', $license->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <!-- Dropdown Tipe Pertandingan -->
                <label for="type" class="fw-bold">Tipe Pertandingan</label>
                <select class="form-control mt-3" id="inputGroupSelect01" name="game_type_id" required>
                    <option selected disabled>Pilih Tipe Pertandingan</option>
                    @foreach ($game_types as $type)
                        <option value="{{ $type->id }}" {{ $license->game_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
                <!-- Dropdown Tingkatan/Level -->
                <label for="city" class="fw-bold mt-3">Tingkatan/Level</label>
                <select class="form-control mt-3" id="kota" name="license_level_id" required>
                    <option selected disabled>Tingkatan/Level</option>
                    @foreach ($license_levels as $level)
                        <option value="{{ $level->id }}"
                            {{ $license->license_level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                    @endforeach
                </select>
                <div class="row">
                    <div class="col">
                        <label for="" class="fw-bold mt-3">Tanggal Mulai</label>
                        <input type="date" id="tanggal-mulai" name="start_date" class="form-control mt-1"
                            placeholder="Tanggal Mulai" value="{{ $license ? $license->start_date : '' }}" required>
                    </div>
                    <div class="col">
                        <label for="" class="fw-bold mt-3">Tanggal Berakhir</label>
                        <input type="date" id="tanggal-berakhir" name="end_date" class="form-control mt-1"
                            placeholder="Tanggal Berakhir" value="{{ $license ? $license->end_date : '' }}" required>
                    </div>
                </div>
                <label for="" class="fw-bold mt-3">Unggah Dokumen (pdf)</label>
                <input type="file" accept="application/pdf" id="dokumen" name="document" class="form-control mt-1"
                    placeholder="Unggah Dokumen">
                <div class="d-grid gap-2 text-center">
                    <button class="btn btn-primary btn-lg mt-4" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
