@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <h2>Profil</h2>
        <p>Data diri akan digunakan pada saat mendaftar sebagai wasit atau pelatih pada sistem.</p>
        @extends('partials.alert')
        <form action="{{ route('postProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="row mt-4">
                    <div class="col">
                        <label for="" class="fw-bold">Nama Depan</label>
                        <input type="text" id="nama-depan" name="first_name" class="form-control mt-1" required
                            placeholder="Nama Depan" value="{{ $user->first_name ? $user->first_name : '' }}">
                    </div>
                    <div class="col">
                        <label for="" class="fw-bold">Nama Belakang</label>
                        <input type="text" id="nama-belakang" name="last_name" class="form-control mt-1" required
                            placeholder="Nama Belakang" value="{{ $user->last_name ? $user->last_name : '' }}">
                    </div>
                </div>
                <label for="" class="fw-bold mt-3">Nama Lengkap</label>
                <input type="text" id="nama-lengkap" name="full_name" class="form-control mt-1" required
                    placeholder="Nama Lengkap" value="{{ $user->full_name ? $user->full_name : '' }}">
                <label for="" class="fw-bold mt-3">Email</label>
                <input type="email" id="email" name="email" class="form-control mt-1" required
                    placeholder="email@email.com" value="{{ $user->email ? $user->email : '' }}">
                <label for="" class="fw-bold mt-3">Jenis Kelamin</label>
                <div class="mt-1">
                    <input type="radio" name="gender" id="laki-laki" value="L"
                        {{ $user->gender == 'L' ? 'checked' : '' }}>
                    <label for="laki-laki">
                        Laki-laki
                    </label>
                </div>
                <div class="mt-1">
                    <input type="radio" name="gender" id="perempuan" value="P"
                        {{ $user->gender == 'P' ? 'checked' : '' }}>
                    <label for="perempuan">
                        Perempuan
                    </label>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label for="" class="fw-bold">Tempat Lahir</label>
                        <input type="text" id="tempat-lahir" name="place_of_birth" class="form-control mt-1" required
                            placeholder="Tempat Lahir" value="{{ $user->place_of_birth ? $user->place_of_birth : '' }}">
                    </div>
                    <div class="col">
                        <label for="" class="fw-bold">Tanggal Lahir</label>
                        <input type="date" id="tanggal-lahir" name="date_of_birth" class="form-control mt-1" required
                            placeholder="Tanggal Lahir" value="{{ $user->date_of_birth ? $user->date_of_birth : '' }}">
                    </div>
                </div>
                <label for="" class="fw-bold mt-3">Nomor Telepon</label>
                <input type="tel" id="telp" name="phone" class="form-control mt-1" required
                    placeholder="Nomor Telepon" value="{{ $user->phone ? $user->phone : '' }}">
                <label for="" class="fw-bold mt-3">Alamat</label>
                <input type="text" id="alamat" name="address" class="form-control mt-1" placeholder="Alamat" required
                    value="{{ $user->address ? $user->address : '' }}">
                <!-- Dropdown Kabupaten/Kota -->
                <label for="city" class="fw-bold mt-3">Kabupaten/Kota</label>
                <select class="form-control mt-3" id="kota" name="city_id" required>
                    <option selected disabled>Kabupaten/Kota</option>
                    @foreach ($cities as $city)
                        @if ($user->city)
                            <option {{ $city->id == $user->city_id ? 'selected' : '' }} value="{{ $city->id }}">
                                {{ $city->name }}</option>
                        @else
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="" class="fw-bold mt-3">Pekerjaan Lainnya (<i class="text-secondary">*jika
                        ada</i>)</label>
                <input type="text" id="pekerjaan" name="other_profession" class="form-control mt-1"
                    placeholder="Pekerjaan Lainnya" value="{{ $user->other_profession ? $user->other_profession : '' }}">
                <label for="" class="fw-bold mt-3">Unggah Foto Profil (<i
                        class="text-secondary">jpg/jpeg/png</i>)</label>
                <input type="file" accept="image/*" id="foto-profil" name="photo" class="form-control mt-1"
                    required placeholder="Unggah Foto Profil">
                <div class="d-grid gap-2 text-center">
                    <button class="btn btn-primary btn-lg mt-4" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
