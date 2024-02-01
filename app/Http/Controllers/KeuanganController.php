<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Keuangan;
use App\LogActivity as AppLogActivity;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KeuanganController extends Controller
{
    public function indexmasuk (Request $request){
        if ($request->ajax()) {
            return Datatables::of(Keuangan::where('type', 'masuk')->with('users')->get())
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => 'Dana Masuk',
        ];
        return view('keuangan.index', $data);
    }

    public function indexkeluar(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Keuangan::where('type', 'keluar')->with('users')->get())
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => 'Dana Keluar',
        ];
        return view('keuangan.index2', $data);
    }


    public function indexsaatini(Request $request)
    {
        if ($request->ajax()) {
            $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            return Datatables::of(
                Keuangan::select([
                    'bulan',
                    'tahun',
                    DB::raw('COALESCE(SUM(CASE WHEN type="masuk" THEN nominal END),0) AS totalmasuk'),
                    DB::raw('COALESCE(SUM(CASE WHEN type="keluar" THEN nominal END),0)  AS totalkeluar'),
                    DB::raw('COALESCE(SUM(CASE WHEN type="masuk" THEN nominal END),0) - COALESCE(SUM(CASE WHEN type="keluar" THEN nominal END),0) AS sisa'),
                ])
                    ->whereIn('bulan', ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
                    ->groupBy('tahun', 'bulan')
                    ->get()
            )
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => 'Dana saat ini',
            'totalsisa' => $this->gettotalsisa(0)[0]->sisa,
        ];
        return view('keuangan.index3', $data);
    }



    public function insert(Request $request){
        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $name = auth()->user()->nama;
        $level = auth()->user()->level;
        // Image Save 
        $imageName = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $imageName = Str::random(40) . '.' . $request->file('bukti_pembayaran')->getClientOriginalExtension();

            $request->file('bukti_pembayaran')->move(public_path('keuangan'), $imageName);
        }


        if($request->type=="masuk"){
            $insertMasuk = new Keuangan;
            $insertMasuk->type = $request->type;
            $insertMasuk->nominal = Str::replaceArray('.', ['', '', '', ''], $request->nominal);
            $insertMasuk->sumber = $request->sumber;
            // get Bulan
            $insertMasuk->bulan = $bulan[str_replace('0', '', (date('m', strtotime($request->tanggal)) - 1))];
            // get tahun
            $insertMasuk->tahun = date('Y', strtotime($request->tanggal));
            $insertMasuk->tanggal = $request->tanggal;
            $insertMasuk->total_uang = 0;
            $insertMasuk->bukti_pembayaran = $imageName;
            $insertMasuk->penerima = $request->penerima;
            $insertMasuk->subjek = $request->subjek;
            $insertMasuk->users_id = $request->users_id;
            $insertMasuk->save();

            LogActivity::addToLog('User <strong>' . $level . '</strong> dengan nama <strong>' . $name . '</strong> melakukan insert dana masuk pada subjek <strong>' . $request->subjek . '</strong>');
        }else{
            $insertKeluar = new Keuangan;
            $insertKeluar->type = $request->type;
            $insertKeluar->nominal = Str::replaceArray('.', ['', '', '', ''], $request->nominal);
            $insertKeluar->sumber = "";
            // gettKeluar
            $insertKeluar->bulan = $bulan[str_replace('0', '', (date('m', strtotime($request->tanggal)) - 1))];
            // gettKeluar
            $insertKeluar->tahun = date('Y', strtotime($request->tanggal));
            $insertKeluar->tanggal = $request->tanggal;
            $insertKeluar->total_uang = 0;
            $insertKeluar->bukti_pembayaran = $imageName;
            $insertKeluar->penerima = null;
            $insertKeluar->subjek = $request->subjek;
            $insertKeluar->users_id = $request->users_id;
            $insertKeluar->save();
            LogActivity::addToLog('User <strong>' . $level . '</strong> dengan nama <strong>' . $name . '</strong> melakukan insert dana keluar pada subjek <strong>' . $request->subjek . '</strong>');
        }

        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }

    public function edit(Request $request)
    {
        $edit = Keuangan::find($request->id);
        return $edit;
    }

    public function update(Request $request){
        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $name = auth()->user()->nama;
        $level = auth()->user()->level;
        // Image Save 
        $imageName = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $imageName = Str::random(40) . '.' . $request->file('bukti_pembayaran')->getClientOriginalExtension();

            $request->file('bukti_pembayaran')->move(public_path('keuangan'), $imageName);
        }


        if($request->type=="masuk"){
            $updateMasuk = Keuangan::find($request->id);
            $updateMasuk->type = $request->type;
            $updateMasuk->nominal = Str::replaceArray('.', ['', '', '', ''], $request->nominal);
            $updateMasuk->sumber = $request->sumber;
            $updateMasuk->bulan = $bulan[str_replace('0', '', (date('m', strtotime($request->tanggal)) - 1))];
            $updateMasuk->tahun = date('Y', strtotime($request->tanggal));
            $updateMasuk->tanggal = $request->tanggal;
            $updateMasuk->total_uang = 0;
            $updateMasuk->bukti_pembayaran = $imageName;
            $updateMasuk->penerima = $request->penerima;
            $updateMasuk->subjek = $request->subjek;
            $updateMasuk->users_id = $request->users_id;
            $updateMasuk->save();

            LogActivity::addToLog('User <strong>' . $level . '</strong> dengan nama <strong>' . $name . '</strong> melakukan update dana masuk pada subjek <strong>' . $request->subjek . '</strong>');
        }else{
            $updateKeluar = Keuangan::find($request->id);
            $updateKeluar->type = $request->type;
            $updateKeluar->nominal = Str::replaceArray('.', ['', '', '', ''], $request->nominal);
            $updateKeluar->sumber = "";
            $updateKeluar->bulan = $bulan[str_replace('0', '', (date('m', strtotime($request->tanggal)) - 1))];
            $updateKeluar->tahun = date('Y', strtotime($request->tanggal));
            $updateKeluar->tanggal = $request->tanggal;
            $updateKeluar->total_uang = 0;
            $updateKeluar->bukti_pembayaran = $imageName;
            $updateKeluar->penerima = null;
            $updateKeluar->subjek = $request->subjek;
            $updateKeluar->users_id = $request->users_id;
            $updateKeluar->save();
            LogActivity::addToLog('User <strong>' . $level . '</strong> dengan nama <strong>' . $name . '</strong> melakukan update dana keluar pada subjek <strong>' . $request->subjek . '</strong>');
        }

        return response()->json(['status' => true, 'message' => 'Tambah berhasil']);
    }



    public function gettotalsisa($tahun = 0, $bulan = "null")
    {
        if ($tahun == 0 && $bulan == "null") {
            $query = Keuangan::select([
                DB::raw('COALESCE(SUM(CASE WHEN type="masuk" THEN nominal END),0) - COALESCE(SUM(CASE WHEN type="keluar" THEN nominal END),0) AS sisa'),
            ])->get();
        }else if ($tahun != 0 && $bulan != "null") {
            $query = Keuangan::select([
                DB::raw('COALESCE(SUM(CASE WHEN type="masuk" THEN nominal END),0) - COALESCE(SUM(CASE WHEN type="keluar" THEN nominal END),0) AS sisa'),
            ])
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->get();
        } else if ($tahun == 0 && $bulan != "null") {
            $query = Keuangan::select([
                DB::raw('COALESCE(SUM(CASE WHEN type="masuk" THEN nominal END),0) - COALESCE(SUM(CASE WHEN type="keluar" THEN nominal END),0) AS sisa'),
            ])
                ->where('bulan', $bulan)
                ->get();
        } else if ($tahun != 0 && $bulan == "null") {
            $query = Keuangan::select([
                DB::raw('COALESCE(SUM(CASE WHEN type="masuk" THEN nominal END),0) - COALESCE(SUM(CASE WHEN type="keluar" THEN nominal END),0) AS sisa'),
            ])
                ->where('tahun', $tahun)
                ->get();
        }
        return $query;
    }

    public function logmasuk(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(LogActivity::logActivityLists('masuk'))
                ->addIndexColumn()
                ->addColumn('text', function (AppLogActivity $row) {
                    return $row->subject;
                })
                ->addColumn('tanggal', function (AppLogActivity $row) {
                    return date('d/m/Y G:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['text', 'tanggal'])
                ->make(true);
        }
    }

    public function logkeluar(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(LogActivity::logActivityLists('keluar'))
                ->addIndexColumn()
                ->addColumn('text', function (AppLogActivity $row) {
                    return $row->subject;
                })
                ->addColumn('tanggal', function (AppLogActivity $row) {
                    return date('d/m/Y G:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['text', 'tanggal'])
                ->make(true);
        }
    }
}
