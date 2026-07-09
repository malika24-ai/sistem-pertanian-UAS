<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index()
    {
        return view('farm.index', [
            'title' => 'Manajemen Lahan',
            'farms' => Farm::with('user')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('farm.create', [
            'title' => 'Tambah Lahan',
            'users' => User::whereHas('role', function($q) { $q->where('name', 'Petani'); })->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'location' => 'required',
            'area' => 'required|numeric',
        ], [
            'user_id.required' => 'Petani pemilik lahan wajib diisi',
            'name.required' => 'Nama lahan wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
            'area.required' => 'Luas lahan wajib diisi',
            'area.numeric' => 'Luas lahan harus berupa angka',
        ]);

        Farm::create($validate);

        return redirect()->route('farm.index')->withSuccess('Lahan berhasil ditambahkan');
    }

    public function show(Farm $farm)
    {
        return view('farm.show', [
            'farm' => $farm,
        ]);
    }

    public function edit(Farm $farm)
    {
        return view('farm.edit', [
            'title' => 'Edit Lahan',
            'farm' => $farm,
            'users' => User::whereHas('role', function($q) { $q->where('name', 'Petani'); })->get(),
        ]);
    }

    public function update(Request $request, Farm $farm)
    {
        $validate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'location' => 'required',
            'area' => 'required|numeric',
        ], [
            'user_id.required' => 'Petani pemilik lahan wajib diisi',
            'name.required' => 'Nama lahan wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
            'area.required' => 'Luas lahan wajib diisi',
            'area.numeric' => 'Luas lahan harus berupa angka',
        ]);

        $farm->update($validate);

        return redirect()->route('farm.index')->withSuccess('Lahan berhasil diperbarui');
    }

    public function destroy(Farm $farm)
    {
        $farm->delete();
        return back()->withSuccess('Lahan berhasil dihapus');
    }
}
