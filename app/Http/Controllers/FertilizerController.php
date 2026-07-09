<?php

namespace App\Http\Controllers;

use App\Models\Fertilizer;
use App\Models\Crop;
use Illuminate\Http\Request;

class FertilizerController extends Controller
{
    public function index()
    {
        return view('fertilizer.index', [
            'title' => 'Catatan Pupuk',
            'records' => Fertilizer::with('crop.farm', 'crop.cropType')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('fertilizer.create', [
            'title' => 'Tambah Catatan Pupuk',
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'usage_date' => 'required|date',
        ]);

        Fertilizer::create($validate);

        return redirect()->route('fertilizer.index')->withSuccess('Catatan pupuk berhasil ditambahkan');
    }

    public function show(Fertilizer $fertilizer)
    {
        return view('fertilizer.show', [
            'record' => $fertilizer,
        ]);
    }

    public function edit(Fertilizer $fertilizer)
    {
        return view('fertilizer.edit', [
            'title' => 'Edit Catatan Pupuk',
            'record' => $fertilizer,
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function update(Request $request, Fertilizer $fertilizer)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'usage_date' => 'required|date',
        ]);

        $fertilizer->update($validate);

        return redirect()->route('fertilizer.index')->withSuccess('Catatan pupuk berhasil diperbarui');
    }

    public function destroy(Fertilizer $fertilizer)
    {
        $fertilizer->delete();
        return back()->withSuccess('Catatan pupuk berhasil dihapus');
    }
}
