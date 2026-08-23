<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function ktp()
    {
        $user = auth::user();

        return view('customer.ktp', compact('user'));
    }

    public function saveKtp(Request $request)
    {
        $validated = $request->validate([
            'ktp_name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16', 'unique:users,nik,' . auth::id()],
            'phone' => ['required', 'string', 'max:20'],
            'ktp_address' => ['required', 'string'],
            'rt_rw' => ['required', 'string', 'max:20'],
            'kelurahan_desa' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'occupation' => ['required', 'string', 'max:100'],
        ]);

        auth::user()->update($validated);

        return redirect()
            ->route('customer.order')
            ->with('success', 'Data KTP berhasil disimpan.');
    }
}