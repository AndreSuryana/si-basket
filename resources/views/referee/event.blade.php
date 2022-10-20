@extends('partials.main')

@section('main')
    <div class="card shadow-sm p-3 bg-body rounded">
        <h2>Event Wasit</h2>
        <p>Daftar data event wasit yang telah ditambahkan.</p>
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
            <a class="btn btn-primary text-white {{ $referee ? '' : 'disabled' }}"
                href="{{ $referee ? route('referee.formEvent') : '#' }}">Tambah Event</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Event</th>
                    <th scope="col">Tingkatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $index => $event)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->level->name }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ ucfirst($event->verified_status) }}</td>
                        <td class="d-flex justify-content-evenly">
                            <a href="{{ env('APP_URL') . $event->document_path }}" target="_blank"><i
                                    class="bi bi-filetype-pdf text-primary px-2"></i></a>
                            <a href="{{ route('referee.formEditEvent', $event->id) }}"><i
                                    class="bi bi-pen text-success px-2"></i></a>
                            <form action="{{ route('referee.deleteEvent', $event->id) }}" method="POST">
                                @csrf
                                <button style="background: none; border: none; padding: 0;" type="submit"><i
                                        class="bi bi-trash text-danger px-2"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data event masih kosong</td>
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
