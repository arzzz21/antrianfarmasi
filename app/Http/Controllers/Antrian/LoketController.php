<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoketController extends Controller
{
    public function index(Request $r)
    {
        $lokets = DB::table('simrspku_antrian.lokets')
            ->where('aktif', 1)
            ->get();

        $antrians = collect();

        if ($r->loket_id) {
            $loketId = $r->loket_id;

            $antrians = DB::table('simrspku_antrian.antrians as a')
                ->join('simrspku_antrian.jenis_antrians as j', 'j.id', '=', 'a.jenis_antrian_id')
                ->join('simrspku_antrian.loket_jenis_antrian as lja', function ($join) use ($loketId) {
                    $join->on('lja.jenis_antrian_id', '=', 'a.jenis_antrian_id')
                        ->where('lja.loket_id', $loketId);
                })
                ->leftJoin('simrspku_antrian.antrian_logs as l', function ($join) {
                    $join->on('l.antrian_id', '=', 'a.id')
                        ->whereRaw('l.id = (
                            SELECT MAX(id)
                            FROM simrspku_antrian.antrian_logs
                            WHERE antrian_id = a.id
                        )');
                })
                ->whereDate('a.tanggal', now())
                ->select(
                    'a.id',
                    'a.nomor_antrian',
                    'j.nama as jenis_antrian',
                    'j.prefix',
                    'l.status as log_status'
                )
                ->orderBy('a.nomor_antrian')
                ->get();
        }

        return view('panggilan.index', compact('lokets', 'antrians'));
    }

    public function panggil(Request $r, $loketId)
    {
        $last = DB::table('simrspku_antrian.antrian_logs')
            ->where('antrian_id', $r->antrian_id)
            ->orderByDesc('id')
            ->first();

        // ❌ jika masih dipanggil
        if ($last && $last->status == 1) {
            return back()->with('error', 'Antrian masih dipanggil');
        }

        DB::table('simrspku_antrian.antrian_logs')->insert([
            'antrian_id' => $r->antrian_id,
            'loket_id'   => $loketId,
            'status'     => 1
        ]);

        return back()->with('success', 'Antrian dipanggil');
    }

    public function data(Request $r)
    {
        if (!$r->loket_id) {
            return response()->json([]);
        }

        $loketId = $r->loket_id;

        $antrians = DB::table('simrspku_antrian.antrians as a')
            ->join('simrspku_antrian.jenis_antrians as j', 'j.id', '=', 'a.jenis_antrian_id')
            ->join('simrspku_antrian.loket_jenis_antrian as lja', function ($join) use ($loketId) {
                $join->on('lja.jenis_antrian_id', '=', 'a.jenis_antrian_id')
                    ->where('lja.loket_id', $loketId);
            })
            ->leftJoin('simrspku_antrian.antrian_logs as l', function ($join) {
                $join->on('l.antrian_id', '=', 'a.id')
                    ->whereRaw('l.id = (
                        SELECT MAX(id)
                        FROM simrspku_antrian.antrian_logs
                        WHERE antrian_id = a.id
                    )');
            })
            ->whereDate('a.tanggal', now())
            ->select(
                'a.id',
                'a.nomor_antrian',
                'j.nama as jenis_antrian',
                'j.prefix',
                'l.status as log_status'
            )
            ->orderBy('a.nomor_antrian')
            ->get();

        return response()->json($antrians);
    }

}
