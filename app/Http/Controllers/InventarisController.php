<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Inventaris;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Inventaris::with('users')->get())
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => 'Inventaris',
        ];
        return view('inventaris.index', $data);
    }
    public function insert(Request $request)
    {
        $insert = new Inventaris();
        $insert->nama_barang = $request->nama_barang;
        $insert->tahun_masuk = $request->tahun_masuk;
        $insert->jumlah = $request->jumlah;
        $insert->keadaan = $request->keadaan;
        $insert->sumber = $request->sumber;
        $insert->users_id = auth()->user()->id;
        $insert->save();
        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function edit($id)
    {
        $edit = Inventaris::find($id);
        return $edit;
    }

    public function update(Request $request)
    {
        $update = Inventaris::find($request->id);
        $update->nama_barang = $request->nama_barang;
        $update->tahun_masuk = $request->tahun_masuk;
        $update->jumlah = $request->jumlah;
        $update->keadaan = $request->keadaan;
        $update->sumber = $request->sumber;
        $update->users_id = auth()->user()->id;
        $update->save();
        return response()->json(['status' => true, 'message' => 'Update berhasil']);
    }

    public function delete($id)
    {
        $delete = Inventaris::find($id);
        $delete->delete();
        if ($delete) {
            return response()->json(['status' => $delete, 'message' => 'Hapus berhasil']);
        }
    }
}
