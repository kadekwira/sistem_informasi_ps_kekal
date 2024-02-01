<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeri;
use Intervention\Image\Facades\Image;

class GaleriController extends Controller
{
    protected $galeri;

    public function __construct(Galeri $galeri)
    {
        $this->galeri = $galeri;
    }

    public function index(Request $request)
    {
        $galeri = $this->galeri->latest('created_at')->paginate(6);
        if ($request->ajax()) {
            return view('galeri.load', ['galeri' => $galeri])->render();
        }
        $title = 'Galeri';
        $data = 'Galeri';
        return view('galeri.index', compact('data', 'title', 'galeri'));
    }

    public function insert(Request $request)
    {
        $insert = new Galeri;
        $insert->judul = $request->judul;
        // jika user upload berkas
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            // resize img
            $path = "galeri";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $destinationPath = public_path($path . '/');
            $img_resize = Image::make($file->getRealPath());
            // $img_resize->resize(256, 256);
            // upload ke folder
            $img_resize->save($destinationPath . $fileName);
            $insert->file = $fileName;
        }
        $insert->users_id = auth()->user()->id;
        $insert->save();
        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function delete($id){
        $del = Galeri::find($id)->delete();
        return response()->json(['status' => true, 'message' => 'Berhasil Menghapus']);
    }
}
