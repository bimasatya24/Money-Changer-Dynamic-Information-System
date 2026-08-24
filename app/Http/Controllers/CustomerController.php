<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function ktp()
    {
        $user = Auth::user();

        return view('customer.ktp', compact('user'));
    }

    public function saveKtp(Request $request)
    {
        $validated = $request->validate([
            'ktp_name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16', 'unique:users,nik,' . Auth::id()],
            'phone' => ['required', 'string', 'max:20'],
            'ktp_address' => ['required', 'string'],
            'rt_rw' => ['required', 'string', 'max:20'],
            'kelurahan_desa' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'occupation' => ['required', 'string', 'max:100'],
        ]);

        Auth::user()->update($validated);

        return redirect()
            ->route('customer.location')
            ->with('success', 'Data KTP berhasil disimpan.');
    }

    public function location()
    {
        return view('customer.location');
    }

    public function saveLocation(Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        session([
            'delivery_location' => [
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
            ],
        ]);

        return back()->with(
            'success',
            'Lokasi pengantaran berhasil dipilih.'
        );
    }
}