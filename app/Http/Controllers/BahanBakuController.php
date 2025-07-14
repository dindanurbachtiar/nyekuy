<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
{
    $bahanBaku = BahanBaku::all();
    return view('modules.materials', compact('bahanBaku'));
}


    public function store(Request $request)
    {
        BahanBaku::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $kode_bahan)
    {
        $bahan = BahanBaku::findOrFail($kode_bahan);
        $bahan->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function getOne($kode_bahan)
    {
        return BahanBaku::findOrFail($kode_bahan);
    }
}

