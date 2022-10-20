<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Game;
use App\Models\GameType;
use App\Models\Level;
use App\Models\LicenseLevel;
use App\Models\Referee;
use App\Models\RefereeEvent;
use App\Models\RefereeLicense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RefereeController extends Controller
{
    public function formData()
    {
        $data = [
            'title' => 'Data Wasit',
            'user' => Auth::user(),
            'cities' => City::all(),
            'levels' => Level::all()
        ];

        return view('referee.data', $data);
    }

    public function data(Request $request)
    {
        try {
            // Validate
            $request->validate([
                'level_id' => 'required|integer',
                'city_id' => 'required|integer',
                'document' => 'required|file|mimes:pdf'
            ]);

            // Prepare referee data
            $data = [
                'user_id' => Auth::user()->id,
                'level_id' => $request->level_id,
                'city_id' => $request->city_id,
                'document_path' => $this->uploadFile($request->document, 'upload/user/document')
            ];

            // Create referee data
            $referee = Referee::where('user_id', Auth::user()->id)->first();
            // dd($referee);
            if ($referee == null) {
                Referee::create($data);
            } else {
                $referee->update($data);
            }

            return redirect()->back()->with([
                'success' => 'Data wasit berhasil disimpan'
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function indexEvent()
    {
        $referee = Auth::user()->referee;

        $data = [
            'title' => 'Event Wasit',
            'referee' => $referee,
            'events' => $referee ? RefereeEvent::where('referee_id', $referee->id)
                ->orderBy('id')->get() : [],
        ];

        return view('referee.event', $data);
    }

    public function formEvent()
    {
        // Check if user role is referee
        if (Auth::user()->referee == null) {
            return redirect()->route('referee.event')->with([
                'error' => 'Mohon maaf Anda belum terdaftar sebagai wasit'
            ]);
        }

        $data = [
            'title' => 'Tambah Event Wasit',
            'cities' => City::all(),
            'levels' => Level::all()
        ];

        return view('referee.event-form', $data);
    }

    public function postEvent(Request $request)
    {
        try {
            // Validate
            $request->validate([
                'event_name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'city_id' => 'required|integer',
                'level_id' => 'required|integer',
                'position' => 'required',
                'document' => 'required|file|mimes:pdf',
                'matches' => 'required|array'
            ]);

            // Prepare event data
            $eventData = [
                'referee_id' => Auth::user()->referee->id,
                'level_id' => $request->level_id,
                'city_id' => $request->city_id,
                'name' => $request->event_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'position' => $request->position,
                'document_path' => $this->uploadFile($request->document, 'upload/user/document')
            ];

            // Create event
            $event = RefereeEvent::create($eventData);

            // Add games on event
            if (count($request->matches[0]) != 0) {
                for ($i = 0; $i < count($request->matches[0]); $i++) {
                    Game::create([
                        'referee_event_id' => $event->id,
                        'team_a' => $request->matches[0][$i],
                        'team_b' => $request->matches[1][$i]
                    ]);
                }
            }

            return redirect()->route('referee.event')->with([
                'success' => 'Berhasil menambah data event baru'
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function formEditEvent($id)
    {
        // Get event
        $event = RefereeEvent::find($id);

        // Check if user role is referee
        if (Auth::user()->referee == null) {
            return redirect()->route('referee.license')->with([
                'error' => 'Mohon maaf Anda belum terdaftar sebagai wasit'
            ]);
        } else if (Auth::user()->referee->id != $event->referee_id) {
            return redirect()->route('referee.license')->with([
                'error' => 'Mohon maaf terjadi kesalahan pada sistem'
            ]);
        }

        $data = [
            'title' => 'Edit Event Wasit',
            'event' => $event,
            'cities' => City::all(),
            'levels' => Level::all()
        ];

        return view('referee.edit-event-form', $data);
    }

    public function editEvent(Request $request, $id)
    {
        try {
            // Validate
            $request->validate([
                'event_name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'city_id' => 'required|integer',
                'level_id' => 'required|integer',
                'position' => 'required',
                'document' => 'nullable|file|mimes:pdf',
                // 'matches' => 'required|array'
            ]);

            // Prepare event data
            $eventData = [
                'referee_id' => Auth::user()->referee->id,
                'level_id' => $request->level_id,
                'city_id' => $request->city_id,
                'name' => $request->event_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'position' => $request->position,
            ];

            // Find event by id
            $event = RefereeEvent::findOrFail($id);

            // Update document if exists in request
            if ($request->document) {
                $eventData['document_path'] = $this->uploadFile($request->document, 'upload/user/document');
                Storage::delete($event->document_path);
            }

            // Update event
            $event->update($eventData);

            // Update or add new games on event
            // dd(count($request->matches[0]));
            if (count($request->matches[0]) != 0) {
                for ($i = 0; $i < count($request->matches[0]); $i++) {
                    if ($i < count($event->games)) {
                        $game = $event->games[$i];
                        $game->update([
                            'team_a' => $request->matches[0][$i],
                            'team_b' => $request->matches[1][$i]
                        ]);
                    } else {
                        Game::create([
                            'referee_event_id' => $event->id,
                            'team_a' => $request->matches[0][$i],
                            'team_b' => $request->matches[1][$i]
                        ]);
                    }
                }
            }

            return redirect()->route('referee.event')->with([
                'success' => 'Berhasil mengubah data event'
            ]);
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteEvent($id)
    {
        try {
            $event = RefereeEvent::findOrFail($id);
            Storage::delete($event->document_path);
            $event->delete();

            return redirect()->back()->with([
                'success' => 'Data event berhasil dihapus'
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function indexLicense()
    {
        $referee = Auth::user()->referee;

        $data = [
            'title' => 'Data Lisensi Wasit',
            'referee' => $referee,
            'licenses' => $referee ? RefereeLicense::where('referee_id', $referee->id)
                ->orderBy('id')->get() : [],
        ];

        return view('referee.license', $data);
    }

    public function formLicense()
    {
        // Check if user role is referee
        if (Auth::user()->referee == null) {
            return redirect()->route('referee.license')->with([
                'error' => 'Mohon maaf Anda belum terdaftar sebagai wasit'
            ]);
        }

        $data = [
            'title' => 'Tambah Lisensi Wasit',
            'user' => Auth::user(),
            'game_types' => GameType::all(),
            'license_levels' => LicenseLevel::all()
        ];

        return view('referee.license-form', $data);
    }

    public function postLicense(Request $request)
    {
        try {
            // Validate
            $request->validate([
                'game_type_id' => 'required|integer',
                'license_level_id' => 'required|integer',
                'start_date' => 'required',
                'end_date' => 'required',
                'document' => 'required|file|mimes:pdf'
            ]);

            // Prepare license data
            $license = [
                'referee_id' => Auth::user()->referee->id,
                'game_type_id' => $request->game_type_id,
                'license_level_id' => $request->license_level_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'document_path' => $this->uploadFile($request->document, 'upload/user/document')
            ];

            // Create license
            RefereeLicense::create($license);

            return redirect()->route('referee.license')->with([
                'success' => 'Berhasil menamabahkan data lisensi baru'
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function formEditLicense($id)
    {
        // Get license 
        $license = RefereeLicense::find($id);

        // Check if user role is referee
        if (Auth::user()->referee == null) {
            return redirect()->route('referee.license')->with([
                'error' => 'Mohon maaf Anda belum terdaftar sebagai wasit'
            ]);
        } else if (Auth::user()->referee->id != $license->referee_id) {
            return redirect()->route('referee.license')->with([
                'error' => 'Mohon maaf terjadi kesalahan pada sistem'
            ]);
        }

        $data = [
            'title' => 'Edit Lisensi Wasit',
            'license' => $license,
            'game_types' => GameType::all(),
            'license_levels' => LicenseLevel::all()
        ];

        return view('referee.edit-license-form', $data);
    }

    public function editLicense(Request $request, $id)
    {
        try {
            // Validate
            $request->validate([
                'game_type_id' => 'required|integer',
                'license_level_id' => 'required|integer',
                'start_date' => 'required',
                'end_date' => 'required',
                'document' => 'nullable|file|mimes:pdf'
            ]);

            // Prepare license data
            $data = [
                'referee_id' => Auth::user()->referee->id,
                'game_type_id' => $request->game_type_id,
                'license_level_id' => $request->license_level_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];

            // Find license by id
            $license = RefereeLicense::findOrFail($id);

            // Update document if exists in request
            if ($request->document) {
                $data['document_path'] = $this->uploadFile($request->document, 'upload/user/document');
                Storage::delete($license->document_path);
            }

            // Update license
            $license->update($data);

            return redirect()->route('referee.license')->with([
                'success' => 'Berhasil mengubah data lisensi'
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->route('referee.license')->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteLicense($id)
    {
        try {
            $license = RefereeLicense::findOrFail($id);
            Storage::delete($license->document_path);
            $license->delete();

            return redirect()->back()->with([
                'success' => 'Lisensi berhasil dihapus'
            ]);
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }
}
