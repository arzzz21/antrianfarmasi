<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianCOntroller extends Controller
{
    public function index()
    {
        $jenis = DB::table('simrspku_antrians.jenis_antrians')->get();
        $loket = DB::table('simrspku_antrians.lokets')->get();

        return view('antrian.index', compact('jenis',  'loket'));
    }

    public function ambil()
    {
        $jenis = DB::table('simrspku_antrians.jenis_antrians')
            ->where('aktif', 1)
            ->get();

        return view('ambil.index', compact('jenis'));
    }

    public function ambilAjax(Request $request)
    {
        $request->validate([
            'jenis_antrian_id' => 'required|exists:db_custom.simrspku_antrians.jenis_antrians,id'
        ]);

        return DB::transaction(function () use ($request) {

            $tanggal = now()->toDateString();

            $last = DB::table('simrspku_antrians.antrians')
                ->where('tanggal', $tanggal)
                ->where('jenis_antrian_id', $request->jenis_antrian_id)
                ->lockForUpdate()
                ->max('nomor_antrian');

            $nomor = ($last ?? 0) + 1;

            DB::table('simrspku_antrians.antrians')->insert([
                'tanggal' => $tanggal,
                'nomor_antrian' => $nomor,
                'jenis_antrian_id' => $request->jenis_antrian_id,
                'created_at' => now()
            ]);

            $jenis = DB::table('simrspku_antrians.jenis_antrians')
                ->where('id', $request->jenis_antrian_id)
                ->first();

            return response()->json([
                'success' => true,
                'nomor'   => $jenis->prefix . str_pad($nomor, 3, '0', STR_PAD_LEFT),
                'jenis'   => $jenis->nama
            ]);
        });
    }

}
