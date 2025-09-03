<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth, Storage;

class ProfilController extends Controller
{
    function index()
    {
        $show = DB::table('aplikasi.pengguna AS ap')
                    ->leftJoin('master.pegawai AS pg','pg.NIP','=','ap.NIP')
                    ->leftJoin('pegawai.kontak_pegawai AS kp','kp.NIP','=','pg.NIP')
                    ->leftJoin('master.referensi AS ref', function($join) {
                        $join->on('ref.ID', '=', 'kp.JENIS')
                                ->where('ref.JENIS', '=', 8);
                    })
                    ->select(
                        'pg.*',
                        'kp.NOMOR AS NOHP',
                        'ref.DESKRIPSI AS JENISNOHP',
                        DB::raw('master.getNamaLengkapPegawai(pg.NIP) AS NAMALENGKAP'),
                        'pg.nama AS NAMA'
                    )
                    ->where('ap.ID', Auth::user()->ID)
                    ->where('pg.STATUS', 1)
                    // ->where('kp.STATUS', 1)
                    ->first();
        // print_r($show);
        // die();
        $data = [
            'show' => $show,
        ];

        return view('pages.setting.profil')->with('list', $data);
    }

    //TTD RESUME
    public function showTtdPeg($NIP)
    {
        $show = DB::table('aplikasi.pengguna AS ap')
            ->leftJoin('master.pegawai AS pg','pg.NIP','=','ap.NIP')
            ->leftJoin('pegawai.kontak_pegawai AS kp','kp.NIP','=','pg.NIP')
            ->leftJoin('master.referensi AS ref', function($join) {
                $join->on('ref.ID', '=', 'kp.JENIS')
                    ->where('ref.JENIS', '=', 8);
            })
            ->select(
                'pg.*',
                'kp.NOMOR AS NOHP',
                'ref.DESKRIPSI AS JENISNOHP',
                DB::raw('master.getNamaLengkapPegawai(pg.NIP) AS NAMALENGKAP')
            )
            ->where('ap.ID', Auth::user()->ID)
            ->where('pg.STATUS', 1)
            ->where('kp.STATUS', 1)
            ->where('ap.NIP',$NIP)
            ->first();

        $existing = DB::table('simrspku_klaim.tanda_tangan_pegawai')
            ->where('nip', $NIP)
            ->whereNull('deleted_at')
            ->first();

        $signature_url = $existing ? asset('storage/' . $existing->signature_path) : null;

        return response()->json([
            'show' => $show,
            'dbttd' => [
                'signature_path' => $existing ? $existing->signature_path : null,
                'signature_url' => $signature_url,
                'signature_date' => $existing ? $existing->updated_at : null,
            ],
        ]);
    }

    public function storeTtdPeg(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'signature' => 'required|string',
        ]);

        $peg = DB::table('aplikasi.pengguna AS ap')
                ->leftJoin('master.pegawai AS pg','pg.NIP','=','ap.NIP')
                ->leftJoin('pegawai.kontak_pegawai AS kp','kp.NIP','=','pg.NIP')
                ->leftJoin('master.referensi AS ref', function($join) {
                    $join->on('ref.ID', '=', 'kp.JENIS')
                        ->where('ref.JENIS', '=', 8);
                })
                ->select(
                    'pg.*',
                    'kp.NOMOR AS NOHP',
                    'ref.DESKRIPSI AS JENISNOHP',
                    DB::raw('master.getNamaLengkapPegawai(pg.NIP) AS NAMALENGKAP'),
                    'pg.nama AS NAMA'
                )
                ->where('ap.ID', Auth::user()->ID)
                ->where('pg.STATUS', 1)
                // ->where('kp.STATUS', 1)
                ->where('ap.NIP',$request->nip)
                ->first();
        // print_r($peg);
        // die();
        $image = str_replace('data:image/png;base64,', '', $request->signature);
        $image = str_replace(' ', '+', $image);
        $filename = 'ttd_' . time() . '.png';

        Storage::disk('public')->put("/signatures/{$filename}", base64_decode($image));

        DB::table('simrspku_klaim.tanda_tangan_pegawai')
            ->where('nip', $request->nip)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now()
            ]);

        DB::table('simrspku_klaim.tanda_tangan_pegawai')->insert([
            'nip' => $request->nip,
            'nama_pegawai' => $peg->NAMALENGKAP ? $peg->NAMALENGKAP : $peg->NAMA,
            'signature_path' => "signatures/{$filename}",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'signature_url' => asset("storage/signatures/{$filename}"),
        ]);
    }

}
