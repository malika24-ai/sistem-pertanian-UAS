<?php

namespace App\Http\Controllers;

use App\Models\HarvestRecord;
use App\Models\Crop;
use Illuminate\Http\Request;

class HarvestRecordController extends Controller
{
    public function index()
    {
        return view('harvest_record.index', [
            'title' => 'Catatan Panen',
            'records' => HarvestRecord::with('crop.farm', 'crop.cropType')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('harvest_record.create', [
            'title' => 'Tambah Catatan Panen',
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'harvest_date' => 'required|date',
            'quantity' => 'required|numeric',
            'quality' => 'nullable',
        ]);

        HarvestRecord::create($validate);

        return redirect()->route('harvest-record.index')->withSuccess('Catatan panen berhasil ditambahkan');
    }

    public function show(HarvestRecord $harvest_record)
    {
        return view('harvest_record.show', [
            'record' => $harvest_record,
        ]);
    }

    public function edit(HarvestRecord $harvest_record)
    {
        return view('harvest_record.edit', [
            'title' => 'Edit Catatan Panen',
            'record' => $harvest_record,
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function update(Request $request, HarvestRecord $harvest_record)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'harvest_date' => 'required|date',
            'quantity' => 'required|numeric',
            'quality' => 'nullable',
        ]);

        $harvest_record->update($validate);

        return redirect()->route('harvest-record.index')->withSuccess('Catatan panen berhasil diperbarui');
    }

    public function destroy(HarvestRecord $harvest_record)
    {
        $harvest_record->delete();
        return back()->withSuccess('Catatan panen berhasil dihapus');
    }
}
