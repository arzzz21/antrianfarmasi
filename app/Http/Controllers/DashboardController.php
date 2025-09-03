<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Pengguna;
use Halimkun\LaravelEklaim\Eklaim;
use Carbon\Carbon;

class DashboardController extends Controller
{
    function index()
    {
        $yearMonth = Carbon::now()->isoFormat('YYYY-MM-DD');

        $data = [
            'yearMonth' => $yearMonth,
        ];

        return view('pages.dashboard.index')->with('list', $data);
    }

    function clearCache()
    {
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
        \Artisan::call('event:clear');
        \Artisan::call('route:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('clear-compiled');
        \Artisan::call('optimize');
        return redirect()->back()->with('message','Cache berhasil dibersihkan!');
    }

    function test()
    {

    }

}


// REFERENSI
    // dd($user->getRoleNames());
    // dd($user->getAllPermissions());$roles = auth()->user()->getRoleNames();
    // dd(auth()->guard('web')->user()->id);

    // Role::create(['name' => 'direksi', 'guard_name' => 'web']);
    // Role::create(['name' => 'dokter', 'guard_name' => 'web']);
    // Role::create(['name' => 'perawat', 'guard_name' => 'web']);
    // Role::create(['name' => 'asuransi', 'guard_name' => 'web']);
    // Permission::create(['name' => 'kunjungan_pasien', 'guard_name' => 'web']);
    // Permission::create(['name' => 'smart_claim', 'guard_name' => 'web']);
    // $user = Pengguna::find(7);
    // $user->assignRole('admin');
    // $user->assignRole('admin');

    // $role = Role::findByName('admin', 'web');
    // $permission = Permission::findByName('monitoring', 'web');
    // $role->givePermissionTo($permission);

    // dd($user->getAllPermissions());
