@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <h2>Tambah Lisensi Wasit</h2>
        <p>Tambahkan data lisensi Anda sebagai wasit basket pada form ini.</p>
        <form action="{{ route('referee.postLicense') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <!-- Dropdown Tipe Pertandingan -->
                <label for="type" class="fw-bold">Tipe Pertandingan</label>
                <select class="form-control mt-3" id="inputGroupSelect01" name="game_type_id" required>
                    <option selected disabled>Pilih Tipe Pertandingan</option>
                    @foreach ($game_types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <!-- Dropdown Tingkatan/Level -->
                <label for="city" class="fw-bold mt-3">Tingkatan/Level</label>
                <select class="form-control mt-3" id="kota" name="license_level_id" required>
                    <option selected disabled>Tingkatan/Level</option>
                    @foreach ($license_levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <div class="row">
                    <div class="col">
                        <label for="" class="fw-bold mt-3">Tanggal Mulai</label>
                        <input type="date" id="tanggal-mulai" name="start_date" class="form-control mt-1"
                            placeholder="Tanggal Mulai" required>
                    </div>
                    <div class="col">
                        <label for="" class="fw-bold mt-3">Tanggal Berakhir</label>
                        <input type="date" id="tanggal-berakhir" name="end_date" class="form-control mt-1"
                            placeholder="Tanggal Berakhir" required>
                    </div>
                </div>
                <label for="" class="fw-bold mt-3">Unggah Dokumen (pdf)</label>
                <input type="file" accept="application/pdf" id="dokumen" name="document" class="form-control mt-1"
                    placeholder="Unggah Dokumen" required>
                <div class="d-grid gap-2 text-center">
                    <button class="btn btn-primary btn-lg mt-4" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
