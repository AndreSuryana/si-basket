@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 bg-body rounded">
        <h2>Lisensi Wasit</h2>
        <p>Daftar data lisensi wasit yang telah ditambahkan.</p>
        @if ($referee == null)
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Pengumuman</h4>
                <p>Mohon maaf, Anda belum terdaftar sebagai wasit pada sistem kami. Mohon untuk melakukan pendaftaran
                    terlebih dahulu pada <a style="text-decoration: none" href="{{ route('referee.data') }}">Menu Wasit - Data
                        Diri</a>.</p>
            </div>
        @endif
        @include('partials.alert')
        <div class="my-2">
            <a href="{{ $referee ? route('referee.formLicense') : '#' }}"
                class="btn btn-primary text-white {{ $referee ? '' : 'disabled' }}">Tambah Lisensi</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tipe Permainan</th>
                    <th scope="col">Tingkatan</th>
                    <th scope="col">Tanggal Expired</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($licenses as $index => $license)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $license->gameType->name }}</td>
                        <td>{{ $license->licenseLevel->name }}</td>
                        <td>{{ $license->end_date }}</td>
                        <td class="d-flex justify-content-start">
                            <a href="{{ env('APP_URL') . $license->document_path }}" target="_blank"><i
                                    class="bi bi-filetype-pdf text-primary px-2"></i></a>
                            <a href="{{ route('referee.formEditLicense', $license->id) }}"><i
                                    class="bi bi-pen text-success px-2"></i></a>
                            <form action="{{ route('referee.deleteLicense', $license->id) }}" method="POST">
                                @csrf
                                <button style="background: none; border: none; padding: 0;" type="submit"><i
                                        class="bi bi-trash text-danger px-2"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data lisensi masih kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
    </div>
@endsection
