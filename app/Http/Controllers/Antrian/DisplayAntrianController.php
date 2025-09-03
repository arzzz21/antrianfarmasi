<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisplayAntrianController extends Controller
{
    public function pilihJenis()
    {
        $jenis = DB::table('simrspku_antrian.jenis_antrians')->get();
        return view('display.pilih', compact('jenis'));
    }

    public function simpanPilihan(Request $request)
    {
        session([
            'display_jenis' => $request->jenis_id,
        ]);
        return redirect()->route('antrian.display.index');
    }

    public function index()
    {
        if (!session('display_jenis')) {
            return redirect()->route('antrian.display.pilih');
        }
        return view('display.index');
    }

    public function data()
    {
        $jenisId = session('display_jenis');

        // antrian yang sedang dipanggil
        $sekarang = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->leftJoin('simrspku_antrian.lokets', 'antrians.loket_id', '=', 'lokets.id')
            ->select('antrians.nomor','lokets.nama AS loket','antrians.updated_at','jenis_antrians.nama AS jenis')
            ->where('jenis_antrians.id', $jenisId)
            ->where('status', 'Dipanggil')
            ->whereDate('tanggal', now())
            ->orderByDesc('antrians.updated_at')
            ->first();

        // 2 antrian sebelumnya (status selesai)
        $sebelumnya = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->leftJoin('simrspku_antrian.lokets', 'antrians.loket_id', '=', 'lokets.id')
            ->select('antrians.nomor','lokets.nama AS loket','antrians.updated_at')
            ->where('jenis_antrians.id', $jenisId)
            ->where('status', 'Dipanggil')
            ->whereDate('tanggal', now())
            ->orderByDesc('antrians.updated_at')
            ->skip(1) // loncati yg paling baru
            ->take(2) // ambil 2
            ->get();

        $jumlah = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->where('jenis_antrians.id', $jenisId)
            ->whereDate('tanggal', now())
            ->count();

        $sisa = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->where('jenis_antrians.id', $jenisId)
            ->where('status', 'Menunggu')
            ->whereDate('tanggal', now())
            ->count();

        return response()->json([
            'sekarang'   => $sekarang,
            'sebelumnya' => $sebelumnya,
            'jumlah'     => $jumlah,
            'sisa'       => $sisa,
        ]);
    }
}
