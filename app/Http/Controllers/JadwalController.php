<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use App\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Jadwal::where('type', 'jadwal')->with('users')->get())
                ->addIndexColumn()
                ->addColumn('hari', function (Jadwal $row) {
                    $har = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                    return $har[date('w', strtotime($row->jadwal))];
                })
                ->addColumn('tanggal', function (Jadwal $row) {
                    return date('d/m/Y', strtotime($row->jadwal));
                })
                ->addColumn('waktu', function (Jadwal $row) {
                    return date('G:i', strtotime($row->jadwal));
                })
                ->rawColumns(['hari', 'tanggal', 'waktu'])
                ->make(true);
        }
        $data = [
            'title' => 'Jadwal',
        ];
        return view('jadwal.index', $data);
    }

    public function pengumuman(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Jadwal::where('type', 'pengumuman')->with('users')->get())
                ->addIndexColumn()
                ->addColumn('hari', function (Jadwal $row) {
                    $har = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                    return $har[date('w', strtotime($row->jadwal))];
                })
                ->addColumn('tanggal', function (Jadwal $row) {
                    return date('d/m/Y', strtotime($row->jadwal));
                })
                ->addColumn('waktu', function (Jadwal $row) {
                    return date('G:i', strtotime($row->jadwal));
                })
                ->rawColumns(['hari', 'tanggal', 'waktu'])
                ->make(true);
        }
    }

    public function insert(Request $request)
    {
        $insert = new Jadwal;
        $insert->type = $request->type;
        if ($request->type == 'pengumuman') {
            $insert->text = trim($request->text);
            $insert->jadwal = date('Y-m-d G:i:s', strtotime($request->jadwal2));
        } else {
            $insert->team1 = $request->team1;
            $insert->team2 = $request->team2;
            // jika user upload berkas
            if ($request->hasFile('logo1')) {
                $file = $request->file('logo1');
                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;
                // resize img
                $path = "jadwal";
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $destinationPath = public_path($path . '/');
                $img_resize = Image::make($file->getRealPath());
                $img_resize->resize(150, 150);
                // upload ke folder
                $img_resize->save($destinationPath . $fileName);
                $insert->logo1 = $fileName;
            }
            if ($request->hasFile('logo2')) {
                $file = $request->file('logo2');
                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;
                // resize img
                $path = "jadwal";
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $destinationPath = public_path($path . '/');
                $img_resize = Image::make($file->getRealPath());
                $img_resize->resize(150, 150);
                // upload ke folder
                $img_resize->save($destinationPath . $fileName);
                $insert->logo2 = $fileName;
            }
            $insert->home_away = $request->home_away;
            $insert->jadwal = date('Y-m-d G:i:s', strtotime($request->jadwal));
            $insert->skor = ($request->skor == "" || $request->skor == null) ? '' : trim($request->skor);
            $insert->lapangan = $request->lapangan;
        }
        $insert->users_id = auth()->user()->id;
        $insert->save();
        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function edit($id)
    {
        $pemain = Jadwal::find($id);
        return $pemain;
    }

    public function update(Request $request)
    {
        $update = Jadwal::find($request->id);
        $update->team1 = $request->team1;
        $update->team2 = $request->team2;
        // jika user upload berkas
        if ($request->hasFile('logo1')) {
            // hapus file lama
            $filePath = 'jadwal/' . $update->logo1;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $file = $request->file('logo1');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "jadwal";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            $img_resize->resize(150, 150);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $update->logo1 = $fileName;
        }
        if ($request->hasFile('logo2')) {
            // hapus file lama
            $filePath = 'jadwal/' . $update->logo2;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $file = $request->file('logo2');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "jadwal";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            $img_resize->resize(150, 150);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $update->logo2 = $fileName;
        }
        $update->home_away = $request->home_away;
        $update->jadwal = date('Y-m-d G:i:s', strtotime($request->jadwal));
        $update->skor = ($request->skor == "" || $request->skor == null) ? '' : $request->skor;
        $update->lapangan = $request->lapangan;
        $update->users_id = auth()->user()->id;
        $update->save();
        return response()->json(['status' => true, 'message' => 'Update berhasil']);
    }

    public function delete($id)
    {
        $delete = Jadwal::find($id);
        $file1 = $delete->logo1;
        $file2 = $delete->logo2;
        $delete->delete();
        if ($delete) {
            if ($file1 != "") {
                $filePath = 'jadwal/' . $file1;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            if ($file2 != "") {
                $filePath = 'jadwal/' . $file2;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            return response()->json(['status' => $delete, 'message' => 'Hapus berhasil']);
        }
    }
}
