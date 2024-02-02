<?php

namespace App\Http\Controllers;

use App\Info;
use App\Jadwal;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class LoginController extends Controller
{
    /** fungsi login */
    public function getLogin()
    {
        $data['berita'] = Info::where('type', 'berita')->get();
        $data['info'] = Info::where('type', 'infopage')->first();
        $data['jadwal'] = Jadwal::where('type', 'jadwal')->whereMonth('jadwal', date('m'))->orderBy('jadwal', 'asc')->get();
        $data['pengumuman'] = Jadwal::where('type', 'pengumuman')->whereMonth('jadwal', date('m'))->orderBy('jadwal', 'desc')->get();
        return view('login', $data);
    }

    public function register()
    {
        return view('register');
    }

    public function postregister(Request $request)
    {
        $user = new User;
        if ($user->where('email', $request->email)->count() > 0) {
            return response()->json(['status' => false, 'message' => 'Maaf, Email yang anda gunakan sudah terdaftar. Mohon gunakan email lain', 'url' => 'register']);
        } else {
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = 'supporter';
            $user->tanggal_lahir = $request->tanggal;
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
            // langsung login
            Auth::loginUsingId($user->id);
            return response()->json(['status' => true, 'message' => 'Pendaftaran berhasil', 'url' => 'supporter']);
        }
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (
                auth()->user()->level != 'admin' && auth()->user()->level != 'supporter' && auth()->user()->level != 'ketua'
            ) {
                $this->logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki hak akses!'
                ]);
            } else {

                if(auth()->user()->status == 0){
                    $this->logout();
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda tidak memiliki hak akses!'
                    ]);
                }else{
                    return response()->json([
                        'success' => true,
                        'level' => auth()->user()->level,
                        'message' => 'Selamat Datang ' . Str::ucfirst(auth()->user()->level) . '!'
                    ]);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal! harap periksa username & password anda'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
