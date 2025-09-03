<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanggilanAntrianController extends Controller
{
    // 🔹 Halaman pilih jenis & loket
    public function pilihJenisLoket()
    {
        $jenis = DB::table('simrspku_antrian.jenis_antrians')->get();
        $lokets = DB::table('simrspku_antrian.lokets')->get();

        return view('antrian.pilih', compact('jenis', 'lokets'));
    }

    // 🔹 Simpan pilihan ke session
    public function simpanPilihan(Request $request)
    {
        $request->validate([
            'jenis_id' => 'required|integer',
            'loket_id' => 'required|integer',
        ]);

        session([
            'jenis_id' => $request->jenis_id,
            'loket_id' => $request->loket_id,
        ]);

        return redirect()->route('antrian.panggil.index');
    }

    public function getLoketByJenis($jenis_id)
    {
        $lokets = DB::table('simrspku_antrian.lokets AS lok')
            ->select('lok.*')
            ->leftJoin('simrspku_antrian.sub_jenis_antrians AS sja', 'lok.sub_jenis_id','=','sja.id')
            ->where('sja.jenis_id', $jenis_id) // pastikan tabel lokets ada kolom jenis_id
            ->get();

        return response()->json($lokets);
    }

    // 🔹 Halaman utama pemanggilan antrian
    public function index()
    {
        $today = date('Y-m-d');

        $jumlah = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->where('tanggal', $today)
            ->where('jenis_antrians.id', session('jenis_id'))
            ->count();
        $sekarang = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->where('tanggal', $today)
            ->where('jenis_antrians.id', session('jenis_id'))
            ->where('status', 'dipanggil')
            ->orderByDesc('antrians.id')
            ->first();
        $selanjutnya = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->where('tanggal', $today)
            ->where('jenis_antrians.id', session('jenis_id'))
            ->where('status', 'menunggu')
            ->orderByDesc('antrians.id')
            ->first();
        $sisa = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->where('tanggal', $today)
            ->where('jenis_antrians.id', session('jenis_id'))
            ->where('status', 'menunggu')
            ->count();

        $dataAntrian = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->leftJoin('simrspku_antrian.lokets', 'antrians.loket_id', '=', 'lokets.id')
            ->select(
                'antrians.id',
                'antrians.nomor',
                'antrians.status',
                'jenis_antrians.nama as jenis',
                'sub_jenis_antrians.nama as subjenis',
                'lokets.nama as loket'
            )
            ->where('antrians.tanggal', $today)
            ->where('jenis_antrians.id', session('jenis_id'))
            ->orderBy('antrians.id')
            ->get();

        return view('antrian.panggilan', compact('jumlah', 'sekarang', 'selanjutnya', 'sisa', 'dataAntrian'));
    }

    // Panggil antrian
    public function panggil($id)
    {
        $loketId = session('loket_id'); // loket yang dipilih petugas

        DB::table('simrspku_antrian.antrians')
            ->where('id', $id)
            ->update([
                'status'   => 'dipanggil',
                'loket_id' => $loketId,
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    // API untuk reload tabel
    public function data()
    {
        $tanggal = now()->toDateString();

        $list = DB::table('simrspku_antrian.antrians AS a')
            ->join('simrspku_antrian.sub_jenis_antrians AS sj', 'a.sub_jenis_id', '=', 'sj.id')
            ->join('simrspku_antrian.jenis_antrians AS j', 'sj.jenis_id', '=', 'j.id')
            ->leftJoin('simrspku_antrian.lokets AS l', 'a.loket_id', '=', 'l.id')
            ->select('a.id','a.nomor','a.status','j.nama AS jenis','sj.nama AS subjenis','l.nama AS loket')
            ->whereDate('a.tanggal', $tanggal)
            ->orderBy('a.nomor')
            ->get();

        return response()->json($list);
    }
    public function getDataAntrian()
    {
        $today = date('Y-m-d');

        $dataAntrian = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->leftJoin('simrspku_antrian.lokets', 'antrians.loket_id', '=', 'lokets.id')
            ->select(
                'antrians.id',
                'antrians.nomor',
                'antrians.status',
                'jenis_antrians.nama as jenis',
                'sub_jenis_antrians.nama as subjenis',
                'lokets.nama as loket'
            )
            ->where('antrians.tanggal', $today)
            ->where('jenis_antrians.id', session('jenis_id'))
            ->orderBy('antrians.id')
            ->get();

        return view('antrian._tabel', compact('dataAntrian'));
    }

}
