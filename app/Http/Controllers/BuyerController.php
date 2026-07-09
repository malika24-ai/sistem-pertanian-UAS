<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        return view('buyer.index', [
            'title' => 'Manajemen Pembeli',
            'records' => Buyer::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('buyer.create', [
            'title' => 'Tambah Pembeli',
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|string|max:255',
        ]);

        Buyer::create($validate);

        return redirect()->route('buyer.index')->withSuccess('Pembeli berhasil ditambahkan');
    }

    public function show(Buyer $buyer)
    {
        return view('buyer.show', [
            'record' => $buyer,
        ]);
    }

    public function edit(Buyer $buyer)
    {
        return view('buyer.edit', [
            'title' => 'Edit Pembeli',
            'record' => $buyer,
        ]);
    }

    public function update(Request $request, Buyer $buyer)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|string|max:255',
        ]);

        $buyer->update($validate);

        return redirect()->route('buyer.index')->withSuccess('Pembeli berhasil diperbarui');
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();
        return back()->withSuccess('Pembeli berhasil dihapus');
    }
}
