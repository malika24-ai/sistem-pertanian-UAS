<?php

namespace App\Http\Controllers;

use App\Models\SalesTransaction;
use App\Models\Buyer;
use App\Models\Crop;
use Illuminate\Http\Request;

class SalesTransactionController extends Controller
{
    public function index()
    {
        return view('sales_transaction.index', [
            'title' => 'Transaksi Penjualan',
            'records' => SalesTransaction::with('buyer', 'crop.farm')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('sales_transaction.create', [
            'title' => 'Tambah Transaksi Penjualan',
            'buyers' => Buyer::all(),
            'crops' => Crop::with('farm')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'buyer_id' => 'required|exists:buyers,id',
            'crop_id' => 'required|exists:crops,id',
            'transaction_date' => 'required|date',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $validate['total'] = $validate['quantity'] * $validate['price'];

        SalesTransaction::create($validate);

        return redirect()->route('sales-transaction.index')->withSuccess('Transaksi penjualan berhasil ditambahkan');
    }

    public function show(SalesTransaction $sales_transaction)
    {
        return view('sales_transaction.show', [
            'record' => $sales_transaction,
        ]);
    }

    public function edit(SalesTransaction $sales_transaction)
    {
        return view('sales_transaction.edit', [
            'title' => 'Edit Transaksi Penjualan',
            'record' => $sales_transaction,
            'buyers' => Buyer::all(),
            'crops' => Crop::with('farm')->get(),
        ]);
    }

    public function update(Request $request, SalesTransaction $sales_transaction)
    {
        $validate = $request->validate([
            'buyer_id' => 'required|exists:buyers,id',
            'crop_id' => 'required|exists:crops,id',
            'transaction_date' => 'required|date',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $validate['total'] = $validate['quantity'] * $validate['price'];

        $sales_transaction->update($validate);

        return redirect()->route('sales-transaction.index')->withSuccess('Transaksi penjualan berhasil diperbarui');
    }

    public function destroy(SalesTransaction $sales_transaction)
    {
        $sales_transaction->delete();
        return back()->withSuccess('Transaksi penjualan berhasil dihapus');
    }
}
