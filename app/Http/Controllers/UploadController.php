<?php

namespace App\Http\Controllers;

use App\Imports\UploadExcelImport;
use App\Models\Upload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUpload = Upload::all();
        return view('admin.index', compact('allUpload'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        Upload::truncate();

        Excel::import(new UploadExcelImport(), $request->file('file'));

        return redirect()->route('admin.index')->with('success', 'Data Excel berhasil diimport!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        return view('admin.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        //
    }
}
