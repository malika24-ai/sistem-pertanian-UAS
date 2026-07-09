<?php

namespace App\Http\Controllers;

use App\Models\WeatherLog;
use App\Models\Farm;
use Illuminate\Http\Request;

class WeatherLogController extends Controller
{
    public function index()
    {
        return view('weather_log.index', [
            'title' => 'Log Cuaca Harian',
            'records' => WeatherLog::with('farm')->orderBy('date', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('weather_log.create', [
            'title' => 'Tambah Log Cuaca',
            'farms' => Farm::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'condition' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        WeatherLog::create($validate);

        return redirect()->route('weather-log.index')->withSuccess('Log cuaca berhasil ditambahkan');
    }

    public function show(WeatherLog $weather_log)
    {
        return view('weather_log.show', [
            'record' => $weather_log,
        ]);
    }

    public function edit(WeatherLog $weather_log)
    {
        return view('weather_log.edit', [
            'title' => 'Edit Log Cuaca',
            'record' => $weather_log,
            'farms' => Farm::all(),
        ]);
    }

    public function update(Request $request, WeatherLog $weather_log)
    {
        $validate = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'condition' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        $weather_log->update($validate);

        return redirect()->route('weather-log.index')->withSuccess('Log cuaca berhasil diperbarui');
    }

    public function destroy(WeatherLog $weather_log)
    {
        $weather_log->delete();
        return back()->withSuccess('Log cuaca berhasil dihapus');
    }
}
