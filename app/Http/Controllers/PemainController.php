<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\User;
use App\Pemain;
use Intervention\Image\Facades\Image;

class PemainController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Pemain::with('users')->get())
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => 'Pemain',
        ];
        return view('pemain.index', $data);
    }

    public function insert(Request $request)
    {
        $pemain = new Pemain;
        $pemain->nama = $request->nama;
        $pemain->posisi = $request->posisi;
        $y = date('Y', strtotime($request->tanggal));
        $now = date('Y');
        $pemain->tanggal_lahir = $request->tanggal;
        $pemain->usia = $now - $y;
        // jika user upload berkas
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "pemain";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            $img_resize->resize(150, 150);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $pemain->avatar = $fileName;
        }
        $pemain->nohp = $request->nohp;
        $pemain->alamat = $request->alamat;
        $pemain->users_id = auth()->user()->id;
        $pemain->save();
        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function edit($id)
    {
        $pemain = Pemain::find($id);
        return $pemain;
    }

    public function update(Request $request)
    {
        $pemain = Pemain::find($request->id);
        $pemain->nama = $request->nama;
        $pemain->posisi = $request->posisi;
        $y = date('Y', strtotime($request->tanggal));
        $now = date('Y');
        $pemain->tanggal_lahir = $request->tanggal;
        $pemain->usia = $now - $y;
        // jika user upload berkas
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "pemain";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            $img_resize->resize(150, 150);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $pemain->avatar = $fileName;
        }
        $pemain->nohp = $request->nohp;
        $pemain->alamat = $request->alamat;
        $pemain->users_id = auth()->user()->id;
        $pemain->save();
        return response()->json(['status' => true, 'message' => 'Update berhasil']);
    }

    public function delete($id)
    {
        $pemain = Pemain::find($id);
        $file = $pemain->avatar;
        $pemain->delete();
        if ($pemain) {
            if ($file != "") {
                $filePath = 'pemain/' . $file;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            return response()->json(['status' => $pemain, 'message' => 'Hapus berhasil']);
        }
    }
}
