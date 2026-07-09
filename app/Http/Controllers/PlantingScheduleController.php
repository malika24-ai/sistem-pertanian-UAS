<?php

namespace App\Http\Controllers;

use App\Models\PlantingSchedule;
use App\Models\Crop;
use Illuminate\Http\Request;

class PlantingScheduleController extends Controller
{
    public function index()
    {
        return view('planting_schedule.index', [
            'title' => 'Jadwal Tanam',
            'schedules' => PlantingSchedule::with('crop.farm', 'crop.cropType')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('planting_schedule.create', [
            'title' => 'Tambah Jadwal Tanam',
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'plant_date' => 'required|date',
            'estimated_harvest_date' => 'required|date',
        ]);

        PlantingSchedule::create($validate);

        return redirect()->route('planting-schedule.index')->withSuccess('Jadwal berhasil ditambahkan');
    }

    public function show(PlantingSchedule $planting_schedule)
    {
        return view('planting_schedule.show', [
            'schedule' => $planting_schedule,
        ]);
    }

    public function edit(PlantingSchedule $planting_schedule)
    {
        return view('planting_schedule.edit', [
            'title' => 'Edit Jadwal Tanam',
            'schedule' => $planting_schedule,
            'crops' => Crop::with('farm', 'cropType')->get(),
        ]);
    }

    public function update(Request $request, PlantingSchedule $planting_schedule)
    {
        $validate = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'plant_date' => 'required|date',
            'estimated_harvest_date' => 'required|date',
        ]);

        $planting_schedule->update($validate);

        return redirect()->route('planting-schedule.index')->withSuccess('Jadwal berhasil diperbarui');
    }

    public function destroy(PlantingSchedule $planting_schedule)
    {
        $planting_schedule->delete();
        return back()->withSuccess('Jadwal berhasil dihapus');
    }
}
