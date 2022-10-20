@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <h2>Formulir Data Wasit</h2>
        <p>Data diri akan digunakan pada saat mendaftar sebagai wasit atau pelatih pada sistem.</p>
        @include('partials.alert')
        <form action="{{ route('referee.postData') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <!-- Dropdown Tingkatan/Level -->
                <label for="city" class="fw-bold mt-3">Tingkatan/Level</label>
                <select class="form-control mt-3" id="kota" name="level_id" required>
                    <option selected disabled>Tingkatan/Level</option>
                    @foreach ($levels as $level)
                        @if ($user->referee)
                            <option {{ $level->id == $user->referee->level_id ? 'selected' : '' }}
                                value="{{ $level->id }}">{{ $level->name }}</option>
                        @else
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endif
                    @endforeach
                </select>
                <!-- Dropdown Kabupaten/Kota -->
                <label for="city" class="fw-bold mt-3">Kabupaten/Kota</label>
                <select class="form-control mt-3" id="kota" name="city_id" required>
                    <option selected disabled>Kabupaten/Kota</option>
                    @foreach ($cities as $city)
                        @if ($user->referee)
                            <option {{ $city->id == $user->referee->city_id ? 'selected' : '' }}
                                value="{{ $city->id }}">{{ $city->name }}</option>
                        @else
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endif
                    @endforeach
                </select>
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
