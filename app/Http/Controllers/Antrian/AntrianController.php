<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianController extends Controller
{
    // Halaman utama (form ambil nomor & panggil)
    public function index()
    {
        $jenis = DB::table('simrspku_antrian.jenis_antrians')->get();
        $subJenis = DB::table('simrspku_antrian.sub_jenis_antrians')->get();
        $loket = DB::table('simrspku_antrian.lokets')->get();

        return view('antrian.index', compact('jenis', 'subJenis', 'loket'));
    }

    public function ambilJenisPage()
    {
        $jenis = DB::table('simrspku_antrian.jenis_antrians')->get();
        return view('antrian.ambil-jenis', compact('jenis'));
    }

    public function ambilSubJenisPage($jenisId)
    {
        $jenis = DB::table('simrspku_antrian.jenis_antrians')->where('id', $jenisId)->first();
        $subJenis = DB::table('simrspku_antrian.sub_jenis_antrians')->where('jenis_id', $jenisId)->get();

        return view('antrian.ambil-subjenis', compact('jenis', 'subJenis'));
    }

    public function ambil($subJenisId)
    {
        $today = now()->toDateString();

        // Ambil sub_jenis dan relasi jenis_antrians (pakai join)
        $subJenis = DB::table('simrspku_antrian.sub_jenis_antrians as sub')
            ->join('simrspku_antrian.jenis_antrians as jenis', 'sub.jenis_id', '=', 'jenis.id')
            ->where('sub.id', $subJenisId)
            ->select('sub.id as sub_id', 'sub.nama as sub_nama', 'sub.urutan', 'jenis.kode', 'jenis.nama as jenis_nama')
            ->first();

        if (!$subJenis) {
            return response()->json(['error' => 'Sub jenis antrian tidak ditemukan'], 404);
        }

        // Gunakan kode huruf dari jenis dan urutan dari sub jenis
        $prefix = $subJenis->kode . $subJenis->urutan;

        // Ambil nomor terakhir hari ini berdasarkan prefix
        $last = DB::table('simrspku_antrian.antrians')
            ->where('sub_jenis_id', $subJenisId)
            ->whereDate('created_at', $today)
            ->where('nomor', 'like', "$prefix-%")
            ->orderByDesc('nomor')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->nomor, strlen($prefix) + 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Jadi 001, 002, dst.
        $finalNomor = $prefix . '-' . $formattedNumber;

        // Simpan ke database
        DB::table('simrspku_antrian.antrians')->insert([
            'sub_jenis_id' => $subJenis->sub_id,
            'nomor' => $finalNomor,
            'status' => 'menunggu',
            'tanggal' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'nomor' => $finalNomor,
            'jenis' => $subJenis->jenis_nama,
            'sub_jenis' => $subJenis->sub_nama,
            'tanggal' => now()->format('d/m/Y H:i'),
        ]);
    }

    public function cetak($id)
    {
        $antrian = DB::table('simrspku_antrian.antrians')
            ->join('simrspku_antrian.sub_jenis_antrians', 'antrians.sub_jenis_id', '=', 'sub_jenis_antrians.id')
            ->join('simrspku_antrian.jenis_antrians', 'sub_jenis_antrians.jenis_id', '=', 'jenis_antrians.id')
            ->select('antrians.*', 'sub_jenis_antrians.nama as sub_nama', 'jenis_antrians.nama as jenis_nama')
            ->where('antrians.id', $id)
            ->first();

        return view('antrian.cetak', compact('antrian'));
    }

    // Petugas panggil antrian
    public function panggil(Request $request)
    {
        $subJenisId = $request->sub_jenis_id;
        $loketId = $request->loket_id;

        $antrian = DB::table('simrspku_antrian.antrians')
            ->where('sub_jenis_id', $subJenisId)
            ->where('status', 'menunggu')
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('id', 'asc')
            ->first();

        if ($antrian) {
            DB::table('simrspku_antrian.antrians')
                ->where('id', $antrian->id)
                ->update([
                    'status' => 'dipanggil',
                    'loket_id' => $loketId,
                    'updated_at' => now(),
                ]);

            return back()->with('success', "Memanggil nomor: $antrian->nomor");
        }

        return back()->with('error', 'Tidak ada antrian menunggu.');
    }

    // Display halaman
    public function display($jenisId)
    {
        return view('antrian.display', compact('jenisId'));
    }

    // API untuk AJAX display
    public function apiDisplay($jenisId)
    {
        $data = DB::table('simrspku_antrian.antrians as a')
            ->join('simrspku_antrian.sub_jenis_antrians as s', 'a.sub_jenis_id', '=', 's.id')
            ->join('simrspku_antrian.lokets as l', 'a.loket_id', '=', 'l.id')
            ->select('a.nomor', 's.nama as sub_jenis', 'l.nama as loket', 'a.status')
            ->where('a.status', 'dipanggil')
            ->where('a.tanggal', date('Y-m-d'))
            ->where('s.jenis_id', $jenisId)
            ->orderBy('a.updated_at', 'desc')
            ->get();

        $sisa = DB::table('simrspku_antrian.antrians as a')
            ->join('simrspku_antrian.sub_jenis_antrians as s', 'a.sub_jenis_id', '=', 's.id')
            ->where('s.jenis_id', $jenisId)
            ->where('a.status', 'menunggu')
            ->where('a.tanggal', date('Y-m-d'))
            ->count();

        return response()->json([
            'data' => $data,
            'sisa' => $sisa,
        ]);
    }

    public function panggilPage()
    {
        $jenis = DB::table('simrspku_antrian.jenis_antrians')->get();
        return view('antrian.panggil', compact('jenis'));
    }

    public function panggilNext($id)
    {
        // Ambil antrian pertama yang statusnya menunggu
        $antrian = DB::table('simrspku_antrian.antrians')
            ->where('sub_jenis_id', $id)
            ->where('status', 'menunggu')
            ->orderBy('nomor')
            ->first();

        if ($antrian) {
            DB::table('simrspku_antrian.antrians')
                ->where('id', $antrian->id)
                ->update(['status' => 'dipanggil']);

            return response()->json([
                'nomor' => $antrian->nomor,
                'sub_jenis' => DB::table('simrspku_antrian.sub_jenis_antrians')->where('id', $id)->value('nama'),
                'waktu' => now()->format('H:i')
            ]);
        }

        return response()->json(['message' => 'Tidak ada antrian menunggu'], 404);
    }

    public function displayPage()
    {
        return view('antrian.display');
    }

    public function displayData()
    {
        // ambil 10 antrian terakhir yg status dipanggil
        $data = DB::table('simrspku_antrian.antrians as a')
            ->join('simrspku_antrian.sub_jenis_antrians as s', 'a.sub_jenis_id', '=', 's.id')
            ->select('a.nomor', 's.nama as sub_jenis', 'a.status', 'a.updated_at')
            ->where('a.status', 'dipanggil')
            ->orderByDesc('a.updated_at')
            ->limit(10)
            ->get();

        return response()->json($data);
    }
}
