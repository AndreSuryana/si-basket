@extends('partials.main')

@section('main')
    <div class="container mt-3">
        <div class="row my-3">
            <div class="col-sm">
                <div class="card shadow-sm p-3 bg-body rounded">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm"><img src="{{ asset('assets/event.png') }}" alt="" width="50px"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm text-primary"><h1>{{ $event_count }}</h1></div>
                        </div>
                        <div class="row">
                            <div class="col-sm"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm"><h6>Event</h6></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card shadow-sm p-3 bg-body rounded">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm"><img src="{{ asset('assets/basketball-ball-variant.png') }}" alt="" width="50px"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm text-primary"><h1>{{ $game_count }}</h1></div>
                        </div>
                        <div class="row">
                            <div class="col-sm"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm"><h6>Permainan</h6></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card shadow-sm p-3 bg-body rounded">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm"><img src="{{ asset('assets/driver-license.png') }}" alt="" width="50px"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm text-primary"><h1>{{ $license_count }}</h1></div>
                        </div>
                        <div class="row">
                            <div class="col-sm"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm"><h6>Lisensi</h6></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card shadow-sm p-3 bg-body rounded">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm"><img src="{{ asset('assets/user.png') }}" alt="" width="50px"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm text-primary"><h1>{{ $referee_count }}</h1></div>
                        </div>
                        <div class="row">
                            <div class="col-sm"></div>
                            <div class="col-sm"></div>
                            <div class="col-sm"><h6>Wasit</h6></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm p-3 bg-body rounded">
            <h2>Event Wasit</h2>
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
                @forelse ($recent_events as $index => $event)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->level->name }}</td>
                        <td>{{ date_format(date_create($event->start_date), 'd F Y') }}</td>
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
        </div>
        <div class="card shadow-sm mt-3 p-3 bg-body rounded">
            <h2>Lisensi</h2>
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
                    @forelse ($recent_licenses as $index => $license)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $license->gameType->name }}</td>
                        <td>{{ $license->licenseLevel->name }}</td>
                        <td>{{ date_format(date_create($license->end_date), 'd F Y') }}</td>
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
        </div>
    </div>
@endsection
