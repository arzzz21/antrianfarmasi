<?php

namespace App\Http\Controllers\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisAntrianController extends Controller
{
    public function index()
    {
        $data = DB::table('simrspku_antrian.jenis_antrians')->get();
        return view('jenis.index', compact('data'));
    }

    public function store(Request $r)
    {
        DB::table('simrspku_antrian.jenis_antrians')->insert([
            'nama' => $r->nama,
            'kode' => strtoupper($r->kode),
            'prefix' => strtoupper($r->prefix),
            'aktif' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Jenis antrian ditambahkan');
    }

    public function toggle($id)
    {
        DB::table('simrspku_antrian.jenis_antrians')
            ->where('id', $id)
            ->update([
                'aktif' => DB::raw('IF(aktif=1,0,1)'),
                'updated_at' => now()
            ]);

        return back();
    }
}
