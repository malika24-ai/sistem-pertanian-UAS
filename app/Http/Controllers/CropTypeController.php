<?php

namespace App\Http\Controllers;

use App\Models\CropType;
use Illuminate\Http\Request;

class CropTypeController extends Controller
{
    public function index()
    {
        return view('crop_type.index', [
            'title' => 'Jenis Tanaman',
            'cropTypes' => CropType::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('crop_type.create', [
            'title' => 'Tambah Jenis Tanaman',
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CropType::create($validate);

        return redirect()->route('crop-type.index')->withSuccess('Jenis Tanaman berhasil ditambahkan');
    }

    public function show(CropType $crop_type)
    {
        return view('crop_type.show', [
            'cropType' => $crop_type,
        ]);
    }

    public function edit(CropType $crop_type)
    {
        return view('crop_type.edit', [
            'title' => 'Edit Jenis Tanaman',
            'cropType' => $crop_type,
        ]);
    }

    public function update(Request $request, CropType $crop_type)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $crop_type->update($validate);

        return redirect()->route('crop-type.index')->withSuccess('Jenis Tanaman berhasil diperbarui');
    }

    public function destroy(CropType $crop_type)
    {
        $crop_type->delete();
        return back()->withSuccess('Jenis Tanaman berhasil dihapus');
    }
}
