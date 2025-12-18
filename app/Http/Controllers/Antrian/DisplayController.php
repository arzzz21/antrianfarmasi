<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{
    public function index()
    {
        return view('display.index');
    }

    public function data()
    {
        $log = DB::table('simrspku_antrians.antrian_logs as l')
            ->join('simrspku_antrians.antrians as a', 'l.antrian_id', '=', 'a.id')
            ->join('simrspku_antrians.jenis_antrians as j', 'a.jenis_antrian_id', '=', 'j.id')
            ->join('simrspku_antrians.lokets as k', 'l.loket_id', '=', 'k.id')
            ->where('l.status', 1)
            ->orderBy('l.created_at')
            ->first([
                'l.id as log_id',
                'a.nomor_antrian',
                'j.prefix',
                'k.nama_loket'
            ]);

        return response()->json($log);
    }

    public function tampil($logId)
    {
        DB::table('simrspku_antrians.antrian_logs')
            ->where('id', $logId)
            ->where('status', 1)
            ->update([
                'status' => 2,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true]);
    }
}
