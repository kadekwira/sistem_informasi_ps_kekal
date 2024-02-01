<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::where('level', '!=', 'supporter')->get())
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => 'Pengurus',
        ];

        return view('pengurus.index', $data);
    }

    public function insert(Request $request)
    {
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->jabatan = $request->jabatan;
        $user->level = $request->level;
        $user->tanggal_lahir = $request->tanggal;
        $y = date('Y', strtotime($request->tanggal));
        $now = date('Y');
        $user->usia = $now - $y;
        // jika user upload berkas
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "profile";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            $img_resize->resize(150, 150);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $user->avatar = $fileName;
        }
        $user->status = 1;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->save();
        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }
        $user->jabatan = $request->jabatan;
        $user->level = $request->level;
        $user->tanggal_lahir = $request->tanggal;
        $y = date('Y', strtotime($request->tanggal));
        $now = date('Y');
        $user->usia = $now - $y;
        // jika user upload berkas
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "profile";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            $img_resize->resize(150, 150);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $user->avatar = $fileName;
        }
        $user->status = 1;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->save();
        return response()->json(['status' => true, 'message' => 'Update berhasil']);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $file = $user->avatar;
        $user->delete();
        if ($user) { 
            if ($file != "") {
                $filePath = 'profile/' . $file;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            return response()->json(['status' => $user, 'message' => 'Hapus berhasil']);
        }
    }
}
