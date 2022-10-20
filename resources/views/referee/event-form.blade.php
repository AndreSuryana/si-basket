@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 bg-body rounded">
        <h2>Tambah Event Wasit</h2>
        <p>Tambahkan data event Anda sebagai wasit basket pada form ini.</p>
        @include('partials.alert')
        <form action="{{ route('referee.postEvent') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama-event" class="fw-bold">Nama Event</label>
                <input type="text" id="nama-event" name="event_name" class="form-control mt-1" placeholder="Nama Event"
                    required>
                <div class="row">
                    <div class="col">
                        <label for="tanggal-mulai" class="fw-bold mt-3">Tanggal Mulai</label>
                        <input type="date" id="tanggal-mulai" name="start_date" class="form-control mt-1"
                            placeholder="Tanggal Mulai" required>
                    </div>
                    <div class="col">
                        <label for="tanggal-berakhir" class="fw-bold mt-3">Tanggal Berakhir</label>
                        <input type="date" id="tanggal-berakhir" name="end_date" class="form-control mt-1"
                            placeholder="Tanggal Berakhir" required>
                    </div>
                </div>
                <!-- Dropdown Kabupaten/Kota -->
                <label for="city" class="fw-bold mt-3">Kabupaten/Kota</label>
                <select class="form-control mt-3" id="kota" name="city_id" required>
                    <option selected disabled>Kabupaten/Kota</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                <!-- Dropdown Tingkatan/Level -->
                <label for="city" class="fw-bold mt-3">Tingkatan/Level</label>
                <select class="form-control mt-3" id="kota" name="level_id" required>
                    <option selected disabled>Tingkatan/Level</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <label for="posisi-jabatan" class="fw-bold mt-3">Posisi/Jabatan Wasit</label>
                <input type="text" id="posisi-jabatan" name="position" class="form-control mt-1"
                    placeholder="Posisi/Jabatan Wasit" required>
                <label for="dokumen" class="fw-bold mt-3">Unggah Dokumen (pdf)</label>
                <input type="file" accept="application/pdf" id="dokumen" name="document" class="form-control mt-1"
                    placeholder="Unggah Dokumen" required>
            </div>
            <h2 class="mt-4">Tambah Match</h2>
            <p>Tambahkan nama tim basket untuk event ini.</p>
            <div class="mb-3">
                <button class="btn btn-primary" id="tambah-tim" type="button">
                    Tambah Tim
                </button>
            </div>
            <div class="d-flex flex-row">
                <div class="d-flex flex-column flex-grow-1">
                    <label for="nama-tim" class="fw-bold">Nama Tim A</label>
                    <input type="text" id="nama-tim" name="matches[0][]" class="form-control mt-1"
                        placeholder="Nama Tim A">
                </div>
                <div class="d-flex flex-column justify-content-center px-3 mt-3">
                    <strong>vs</strong>
                </div>
                <div class="d-flex flex-column flex-grow-1">
                    <label for="nama-tim" class="fw-bold">Nama Tim B</label>
                    <input type="text" id="nama-tim" name="matches[1][]" class="form-control mt-1"
                        placeholder="Nama Tim B">
                </div>
            </div>
            <div class="d-grid gap-2 text-center">
                <button class="btn btn-primary btn-lg mt-4" type="submit">Tambah Data</button>
            </div>
    </div>
@endsection

@section('js-body')
    <script>
        $(document).ready(function() {
            var newElement = `
            <div class="d-flex flex-row mt-3">
                <div class="d-flex flex-column flex-grow-1">
                    <input type="text" id="nama-tim" name="matches[0][]" class="form-control mt-1" placeholder="Nama Tim A">
                </div>
                <div class="d-flex flex-column justify-content-center px-3 mt-3">
                    <strong>vs</strong>
                </div>
                <div class="d-flex flex-column flex-grow-1">
                    <input type="text" id="nama-tim" name="matches[1][]" class="form-control mt-1" placeholder="Nama Tim B">
                </div>
            </div>
            `;

            $('#tambah-tim').click(function(e) {
                e.preventDefault();
                $('form .flex-row').last().after(newElement);
            });
        });
    </script>
@endsection
