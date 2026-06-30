<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoketMasterController extends Controller
{
    public function index()
    {
        $lokets = DB::table('simrspku_antrian.lokets')->get();

        $jenisAntrians = DB::table('simrspku_antrian.jenis_antrians')
            ->where('aktif', 1)
            ->get();

        // ambil relasi loket ↔ jenis
        $relasi = DB::table('simrspku_antrian.loket_jenis_antrian')
            ->get()
            ->groupBy('loket_id');

        return view('loket_master.index', compact(
            'lokets',
            'jenisAntrians',
            'relasi'
        ));
    }

    public function store(Request $r)
    {
        DB::transaction(function () use ($r) {

            $loketId = DB::table('simrspku_antrian.lokets')->insertGetId([
                'nama_loket' => $r->nama_loket,
                'aktif' => 1
            ]);

            if ($r->filled('jenis_antrian_ids')) {
                foreach ($r->jenis_antrian_ids as $jenisId) {
                    DB::table('simrspku_antrian.loket_jenis_antrian')->insert([
                        'loket_id' => $loketId,
                        'jenis_antrian_id' => $jenisId
                    ]);
                }
            }
        });

        return back()->with('success', 'Loket berhasil ditambahkan');
    }

    public function update(Request $r, $id)
    {
        DB::beginTransaction();

        try {
            // 1. Update nama loket
            DB::table('simrspku_antrian.lokets')
                ->where('id', $id)
                ->update([
                    'nama_loket' => $r->nama_loket,
                    'updated_at' => now()
                ]);

            // 2. Hapus relasi lama
            DB::table('simrspku_antrian.loket_jenis_antrian')
                ->where('loket_id', $id)
                ->delete();

            // 3. Insert relasi baru (jika ada)
            if ($r->filled('jenis_antrian_ids')) {
                foreach ($r->jenis_antrian_ids as $jenisId) {
                    DB::table('simrspku_antrian.loket_jenis_antrian')->insert([
                        'loket_id' => $id,
                        'jenis_antrian_id' => $jenisId
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Loket berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui loket');
        }
    }

    public function toggle($id)
    {
        DB::table('simrspku_antrian.lokets')
            ->where('id', $id)
            ->update(['aktif' => DB::raw('IF(aktif=1,0,1)')]);
        return back();
    }
}
