<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Game;
use App\Models\Referee;
use App\Models\RefereeEvent;
use App\Models\RefereeLicense;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function dashboard()
    {
        return view('main.dashboard', [
            'title' => 'Dashboard',
            'recent_events' => RefereeEvent::orderByDesc('created_at')->limit(5)->get(),
            'recent_licenses' => RefereeLicense::orderByDesc('created_at')->limit(5)->get(),
            'event_count' => RefereeEvent::count(),
            'license_count' => RefereeLicense::count(),
            'game_count' => Game::count(),
            'referee_count' => Referee::count(),
        ]);
    }

    public function formProfile()
    {
        $data = [
            'title' => 'Profile',
            'user' => Auth::user(),
            'cities' => City::all()
        ];

        return view('main.profile', $data);
    }

    public function profile(Request $request)
    {
        try {
            // Get current user id
            $userId = Auth::user()->id;

            // Validate
            $request->validate([
                'first_name'        => 'required',
                'last_name'         => 'required',
                'full_name'         => 'required',
                'email'             => 'required|email',
                'gender'            => 'required',
                'place_of_birth'    => 'required',
                'date_of_birth'     => 'required',
                'phone'             => 'required',
                'address'           => 'required',
                'city_id'           => 'required',
                'other_profession'  => 'nullable',
                'photo'             => 'image|mimes:jpg,jpeg,png'
            ]);


            // Create user data
            $userData = [
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'full_name'         => $request->full_name,
                'email'             => $request->email,
                'gender'            => $request->gender,
                'place_of_birth'    => $request->place_of_birth,
                'date_of_birth'     => $request->date_of_birth,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'city_id'           => $request->city_id,
                'other_profession'  => $request->other_profession,
                'photo_path'        => $this->uploadFile($request->photo, 'upload/user/image')
            ];

            // Update user
            $updated = User::find($userId)
                ->update($userData);

            if ($updated) {
                return redirect()->back()->with([
                    'success' => 'Data diri berhasil diubah'
                ]);
            } else {
                return redirect()->back()->with([
                    'error' => 'Data diri gagal diubah'
                ]);
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }
}
