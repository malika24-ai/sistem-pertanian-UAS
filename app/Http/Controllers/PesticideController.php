<?php

namespace App\Http\Controllers;

use App\Models\Pesticide;
use App\Models\Crop;
use Illuminate\Http\Request;

class PesticideController extends Controller
{
    public function index()
    {
        return view('pesticide.index', [
            'title' => 'Catatan Pestisida',
            'records' => Pesticide::with('crop.farm', 'crop.cropType')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('pesticide.create', [
            'title' => 'Tambah Catatan Pestisida',
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

        Pesticide::create($validate);

        return redirect()->route('pesticide.index')->withSuccess('Catatan pestisida berhasil ditambahkan');
    }

    public function show(Pesticide $pesticide)
    {
        return view('pesticide.show', [
            'record' => $pesticide,
        ]);
    }

    public function edit(Pesticide $pesticide)
    {
        return view('pesticide.edit', [
            'title' => 'Edit Catatan Pestisida',
            'record' => $pesticide,
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function update(Request $request, Pesticide $pesticide)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'usage_date' => 'required|date',
        ]);

        $pesticide->update($validate);

        return redirect()->route('pesticide.index')->withSuccess('Catatan pestisida berhasil diperbarui');
    }

    public function destroy(Pesticide $pesticide)
    {
        $pesticide->delete();
        return back()->withSuccess('Catatan pestisida berhasil dihapus');
    }
}
