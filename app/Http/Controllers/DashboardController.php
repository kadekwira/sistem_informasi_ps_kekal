<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Intervention\Image\Facades\Image;
use App\Info;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->level == 'admin') {
            if ($request->ajax()) {
                return Datatables::of(Info::all())
                    ->addIndexColumn()
                    ->make(true);
            }
            $data = [
                'jadwal' => Jadwal::where('type', 'jadwal')->whereMonth('jadwal', date('m'))->orderBy('jadwal', 'asc')->get(),
                'pengumuman' => Jadwal::where('type', 'pengumuman')->whereMonth('jadwal', date('m'))->orderBy('jadwal', 'desc')->get(),
            ];
            return view('dashboard', $data);
        } elseif (auth()->user()->level == 'supporter') {
            $data = [
                'jadwal' => Jadwal::where('type', 'jadwal')->whereMonth('jadwal', date('m'))->orderBy('jadwal', 'asc')->get(),
                'pengumuman' => Jadwal::where('type', 'pengumuman')->whereMonth('jadwal', date('m'))->orderBy('jadwal', 'desc')->get(),
            ];
            return view('dashboard', $data);
        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    }

    public function insert(Request $request)
    {
        $info = new Info;
        $info->type = $request->type;
        $info->link = (empty($request->link)) ? '-' : $request->link;
        $info->text = trim($request->text);
        $info->save();
        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function infoedit($id)
    {
        $info = Info::find($id);
        return $info;
    }

    public function infodelete($id)
    {
        $info = Info::find($id);
        $info->delete();
        return response()->json(['status' => true, 'message' => 'Hapus berhasil']);
    }

    public function updateinfo(Request $request)
    {
        $info = Info::find($request->id);
        $info->type = $request->type;
        $info->link = (empty($request->link)) ? '-' : $request->link;
        $info->text = trim($request->text);
        $info->save();
        return response()->json(['status' => true, 'message' => 'Update berhasil']);
    }

    public function profile()
    {
        $profile = User::find(auth()->user()->id);
        $data = [
            'title' => 'Setting Profile',
            'user' => $profile,
        ];
        return view('profile', $data);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }
        $user->tanggal_lahir = $request->tanggal;
        $y = date('Y', strtotime($request->tanggal));
        $now = date('Y');
        $user->usia = $now - $y;
        // jika user upload berkas
        if ($request->hasFile('foto')) {
            // hapus file lama
            $filePath = 'profile/' . $user->avatar;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
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
        return response()->json(['status' => true, 'message' => 'Update Profile berhasil']);
    }
}
