<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\simrspku_klaim\klaim_verifikasi_catatan;
use App\Models\simrspku_klaim\klaim_verifikasi;
use App\Models\simrspku_klaim\klaim_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PHPJasper\PHPJasper;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use Auth, Storage;

class ApiDashboardController extends Controller
{
    function dataDiag($tgl)
    {
        $exTgl = explode('-',$tgl); // Array ( [0] => 2025 [1] => 05 [2] => 23 )
        $textTgl = Carbon::createFromFormat('Y-m-d', $tgl)->isoFormat('MMMM Y');
        // print_r($textTgl);
        // die();
        $verified = DB::table('simrspku_klaim.klaim_verifikasi AS kv')
                ->select(DB::raw('count(kv.nomor) as total'))
                ->where('kv.tahun', $exTgl[0]) // 2025
                ->where('kv.bulan', $exTgl[1]) // 05
                ->where('kv.verif', true)
                ->whereNull('kv.deleted_at')
                ->value('total');

        $unverified = DB::table('pendaftaran.kunjungan AS pk')
                ->select(DB::raw('count(pk.NOMOR) as total'))
                ->leftJoin('pendaftaran.penjamin AS pj','pj.NOPEN','=','pk.NOPEN')
                ->leftJoin('pembayaran.tagihan_pendaftaran AS tp', function($join) {
                    $join->on('tp.PENDAFTARAN','=','pk.NOPEN')
                        ->where('tp.UTAMA', 1)
                        ->where('tp.STATUS', 1);
                })
                ->leftJoin('medicalrecord.perencanaan_rawat_inap AS pri', function($join) {
                    $join->on('pri.KUNJUNGAN','=','pk.NOMOR')
                            ->whereNull('pri.KUNJUNGAN');
                })
                ->leftJoin('simrspku_klaim.klaim_verifikasi AS kv', function($join) {
                    $join->on('kv.nomor','=','pk.NOMOR')
                        // ->where('kv.verif', false)
                        ->whereNull('kv.deleted_at');
                })
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('pk.RUANGAN', 'LIKE', '1020101%')
                            ->where('tp.UTAMA', 1)
                            ->where('tp.STATUS', 1);
                    })->orWhere(function ($q) {
                        // KHUSUS RUANGAN IGD (1020201)
                        $q->where('pk.RUANGAN', 'LIKE', '1020201%')
                            ->where('tp.UTAMA', 1)
                            ->where('tp.STATUS', 1);
                    })->orWhere(function ($q) {
                        // KHUSUS RUANGAN REHAB MEDIK (1020201)
                        $q->where('pk.RUANGAN', 'LIKE', '1020702%');
                    });
                })
                // ->whereYear('pk.MASUK', $exTgl[0]) // 2025
                // ->whereMonth('pk.MASUK', (int) $exTgl[1]) // 05
                ->whereDate('pk.MASUK',$tgl)
                ->where('pj.JENIS', 2) // PENJAMIN BPJS ONLY
                ->whereIn('pk.STATUS', [1, 2])
                ->where('pk.KELUAR', '!=', null)
                ->where(function ($q) {
                        $q->whereNull('kv.nomor') // tidak ada klaim
                        ->orWhere('kv.verif', 0); // atau klaim belum diverifikasi
                    })
                ->whereNull('pk.REF')
                ->value('total');

        $duplicates = DB::table('pendaftaran.kunjungan AS pk')
                ->select('tp.TAGIHAN', DB::raw('COUNT(pk.NOMOR) as jumlah'))
                ->leftJoin('medicalrecord.perencanaan_rawat_inap AS pri','pri.KUNJUNGAN','=','pk.NOMOR')
                ->leftJoin('pembayaran.tagihan_pendaftaran AS tp', function($join) {
                    $join->on('tp.PENDAFTARAN','=','pk.NOPEN')
                        ->where('tp.UTAMA', 1)
                        ->where('tp.STATUS', 1);
                })
                ->leftJoin('pendaftaran.penjamin AS pj','pj.NOPEN','=','pk.NOPEN')
                ->leftJoin('simrspku_klaim.klaim_verifikasi AS kv', function($join) {
                    $join->on('kv.nomor','=','pk.NOMOR')
                        ->where('kv.verif', false)
                        ->whereNull('kv.deleted_at');
                })
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('pk.RUANGAN', 'LIKE', '1020101%')
                        ->where('tp.UTAMA', 1)
                        ->where('tp.STATUS', 1)
                        ->whereNull('pri.KUNJUNGAN');
                    })->orWhere(function ($q) {
                        $q->where('pk.RUANGAN', 'LIKE', '1020201%')
                        ->where('tp.UTAMA', 1)
                        ->where('tp.STATUS', 1)
                        ->whereNull('pri.KUNJUNGAN');
                    })->orWhere(function ($q) {
                        $q->where('pk.RUANGAN', 'LIKE', '1020702%');
                    });
                })
                // ->whereYear('pk.MASUK', $exTgl[0])
                // ->whereMonth('pk.MASUK', (int) $exTgl[1])
                // ->whereDay('pk.MASUK','30')
                ->whereDate('pk.MASUK',$tgl)
                ->where('pj.JENIS', 2)
                ->whereIn('pk.STATUS', [1, 2])
                ->whereNull('pk.REF')
                ->whereNotNull('pk.KELUAR')
                ->groupBy('tp.TAGIHAN')
                ->havingRaw('COUNT(pk.NOMOR) > 1')
                ->get();

        $unsolved = DB::table('simrspku_klaim.klaim_verifikasi_catatan AS kvc')
                ->select(DB::raw('count(distinct kvc.nomor) as total'))
                ->leftJoin('pendaftaran.kunjungan AS pk','pk.NOMOR','=','kvc.nomor')
                ->where('kvc.status', true)
                ->where('kvc.solved', false)
                ->whereNull('kvc.deleted_at')
                // ->whereYear('pk.MASUK', $exTgl[0]) // 2025
                // ->whereMonth('pk.MASUK', $exTgl[1]) // 05
                ->whereDate('pk.MASUK',$tgl)
                ->whereIn('pk.STATUS',[1,2])
                ->value('total');

        $kunjIRJbulan = DB::table('pendaftaran.kunjungan AS pk')
                ->select(DB::raw('count(pk.NOMOR) as total'))
                ->leftJoin('pendaftaran.penjamin AS pj','pj.NOPEN','=','pk.NOPEN')
                ->leftJoin('pembayaran.tagihan_pendaftaran AS tp', function($join) {
                    $join->on('tp.PENDAFTARAN','=','pk.NOPEN')
                        ->where('tp.UTAMA', 1)
                        ->where('tp.STATUS', 1);
                })
                ->leftJoin('medicalrecord.perencanaan_rawat_inap AS pri', function($join) {
                    $join->on('pri.KUNJUNGAN','=','pk.NOMOR')
                            ->whereNull('pri.KUNJUNGAN');
                })
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('pk.RUANGAN', 'LIKE', '1020101%')
                            ->where('tp.UTAMA', 1)
                            ->where('tp.STATUS', 1);
                    })->orWhere(function ($q) {
                        // KHUSUS RUANGAN IGD (1020201)
                        $q->where('pk.RUANGAN', 'LIKE', '1020702%');
                    });
                })
                ->whereYear('pk.MASUK', $exTgl[0]) // 2025
                ->whereMonth('pk.MASUK', (int) $exTgl[1]) // 05
                ->where('pj.JENIS', 2) // PENJAMIN BPJS ONLY
                ->whereIn('pk.STATUS', [1, 2])
                ->where('pk.KELUAR', '!=', null)
                ->whereNull('pk.REF')
                ->value('total');

        $kunjIRDbulan = DB::table('pendaftaran.kunjungan AS pk')
                ->select(DB::raw('count(pk.NOMOR) as total'))
                ->leftJoin('pendaftaran.penjamin AS pj','pj.NOPEN','=','pk.NOPEN')
                ->leftJoin('pembayaran.tagihan_pendaftaran AS tp', function($join) {
                    $join->on('tp.PENDAFTARAN','=','pk.NOPEN')
                        ->where('tp.UTAMA', 1)
                        ->where('tp.STATUS', 1);
                })
                ->leftJoin('medicalrecord.perencanaan_rawat_inap AS pri', function($join) {
                    $join->on('pri.KUNJUNGAN','=','pk.NOMOR')
                            ->whereNull('pri.KUNJUNGAN');
                })
                ->where(function ($query) {
                    $query->where('pk.RUANGAN', 'LIKE', '1020201%')
                            ->where('tp.UTAMA', 1)
                            ->where('tp.STATUS', 1); // RADAR
                })
                ->whereYear('pk.MASUK', $exTgl[0]) // 2025
                ->whereMonth('pk.MASUK', (int) $exTgl[1]) // 05
                ->where('pj.JENIS', 2) // PENJAMIN BPJS ONLY
                ->whereIn('pk.STATUS', [1, 2])
                ->where('pk.KELUAR', '!=', null)
                // ->where('tp.UTAMA', 1) // RADAR & TIDAK DENGAN RANAP
                // ->where('tp.STATUS', 1) // RADAR & TIDAK DENGAN RANAP
                ->whereNull('pk.REF')
                ->value('total');

        $kunjIRJtahun = DB::table('pendaftaran.kunjungan AS pk')
                ->select(DB::raw('count(pk.NOMOR) as total'))
                ->leftJoin('pendaftaran.penjamin AS pj','pj.NOPEN','=','pk.NOPEN')
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('pk.RUANGAN', 'LIKE', '1020101%');
                    })->orWhere(function ($q) {
                        // KHUSUS RUANGAN IGD (1020201)
                        $q->where('pk.RUANGAN', 'LIKE', '1020702%');
                    });
                })
                ->whereYear('pk.MASUK', $exTgl[0]) // 2025
                ->where('pj.JENIS', 2) // PENJAMIN BPJS ONLY
                ->whereIn('pk.STATUS', [1, 2])
                ->where('pk.KELUAR', '!=', null)
                ->whereNull('pk.REF')
                ->value('total');

        $kunjIRDtahun = DB::table('pendaftaran.kunjungan AS pk')
                ->select(DB::raw('count(pk.NOMOR) as total'))
                ->leftJoin('pendaftaran.penjamin AS pj','pj.NOPEN','=','pk.NOPEN')
                ->leftJoin('pembayaran.tagihan_pendaftaran AS tp','tp.PENDAFTARAN','=','pk.NOPEN')
                ->leftJoin('medicalrecord.perencanaan_rawat_inap AS pri', function($join) {
                    $join->on('pri.KUNJUNGAN','=','pk.NOMOR')
                            ->whereNull('pri.KUNJUNGAN');
                })
                ->where(function ($query) {
                    $query->where('pk.RUANGAN', 'LIKE', '1020201%')
                            ->where('tp.UTAMA', 1)
                            ->where('tp.STATUS', 1); // RADAR
                })
                ->whereYear('pk.MASUK', $exTgl[0]) // 2025
                ->where('pj.JENIS', 2) // PENJAMIN BPJS ONLY
                ->whereIn('pk.STATUS', [1, 2])
                ->where('pk.KELUAR', '!=', null)
                ->whereNull('pk.REF')
                ->where('tp.UTAMA', 1) // RADAR & TIDAK DENGAN RANAP
                ->where('tp.STATUS', 1) // RADAR & TIDAK DENGAN RANAP
                ->value('total');

        $data = [
            'verified' => $verified,
            'unverified' => $unverified,
            'duplicates' => $duplicates,
            'unsolved' => $unsolved,
            'kunjirjbln' => $kunjIRJbulan,
            'kunjirdbln' => $kunjIRDbulan,
            'kunjirjth' => $kunjIRJtahun,
            'kunjirdth' => $kunjIRDtahun,
            'tgl' => $exTgl,
            'textTgl' => $textTgl,
        ];

        return response()->json($data, 200);
    }
}
