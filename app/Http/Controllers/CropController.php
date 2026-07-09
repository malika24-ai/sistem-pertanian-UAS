<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\CropType;
use App\Models\Farm;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function index()
    {
        return view('crop.index', [
            'title' => 'Manajemen Tanaman',
            'crops' => Crop::with('farm', 'cropType')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('crop.create', [
            'title' => 'Tambah Tanaman',
            'farms' => Farm::all(),
            'cropTypes' => CropType::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'crop_type_id' => 'required|exists:crop_types,id',
            'name' => 'required|string|max:255',
            'plant_date' => 'required|date',
            'estimated_harvest_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        Crop::create($validate);

        return redirect()->route('crop.index')->withSuccess('Tanaman berhasil ditambahkan');
    }

    public function show(Crop $crop)
    {
        return view('crop.show', [
            'crop' => $crop,
        ]);
    }

    public function edit(Crop $crop)
    {
        return view('crop.edit', [
            'title' => 'Edit Tanaman',
            'crop' => $crop,
            'farms' => Farm::all(),
            'cropTypes' => CropType::all(),
        ]);
    }

    public function update(Request $request, Crop $crop)
    {
        $validate = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'crop_type_id' => 'required|exists:crop_types,id',
            'name' => 'required|string|max:255',
            'plant_date' => 'required|date',
            'estimated_harvest_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        $crop->update($validate);

        return redirect()->route('crop.index')->withSuccess('Tanaman berhasil diperbarui');
    }

    public function destroy(Crop $crop)
    {
        $crop->delete();
        return back()->withSuccess('Tanaman berhasil dihapus');
    }
}
