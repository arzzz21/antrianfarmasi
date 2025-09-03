<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Pengguna;
use Carbon\Carbon;
use DB;

class RolesController extends Controller
{
    function index()
    {
        return view('pages.setting.roles');
    }

    // API ------------------------------------------------------------------------------------------------------------------

    function dataRoles()
    {
        $show = Role::with('permissions')->get();

        $data = [
            'show' => $show,
        ];

        // print_r($data);
        // die();
        return response()->json($data, 200);
    }

    function createRoles(Request $request)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';
        $show = Role::create(['name' => $request->jabatan, 'guard_name' => 'web']);

        return response()->json($now, 200);
    }

    function showRoles($id)
    {
        $role = Role::all();
        $user = Pengguna::find($id);
        $user_role_id = $user->roles->first()->id ?? null;
        $user_role_name = $user->roles->first()->name ?? null;

        $data = [
            'role' => $role,
            'id' => $user_role_id,
            'name' => $user_role_name,
        ];

        return response()->json($data, 200);
    }

    function updateRoles(Request $request)
    {
        // $show = Role::find($request->id);
        // $show->name = $request->name;
        // $show->save();

        // return response()->json($show, 200);
    }

    function deleteRoles($id)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';
        $role  = Role::find($id);

        // Pastikan role dengan ID tersebut ada
        $role = DB::connection('db_custom')->table('roles')->where('id', $id)->first();

        if (!$role) {
            return response()->json(['error' => 'Role tidak ditemukan'], 404);
        }

        // Hapus relasi role_has_permissions
        DB::connection('db_custom')
            ->table('role_has_permissions')
            ->where('role_id', $id)
            ->delete();

        // Hapus relasi model_has_roles
        DB::connection('db_custom')
            ->table('model_has_roles')
            ->where('role_id', $id)
            ->delete();

        // Hapus role dari tabel roles
        DB::connection('db_custom')
            ->table('roles')
            ->where('id', $id)
            ->delete();

        return response()->json($now, 200);
    }

    // USER ------------------------------------------------------------------------------------------------------------------

    function dataRolesUser()
    {
        $show = DB::table('aplikasi.pengguna AS ap')
                ->leftJoin('master.pegawai AS pg','pg.NIP','=','ap.NIP')
                ->leftJoin('simrspku_klaim.model_has_roles AS mhr', function($join) {
                    $join->on('mhr.model_id', '=', 'ap.ID')
                            ->where('mhr.model_type', '=', 'App\Models\Pengguna');
                })
                ->leftJoin('simrspku_klaim.roles AS r', 'r.id', '=', 'mhr.role_id')
                ->select(
                    'pg.*',
                    'ap.NAMA as APNAMA',
                    'ap.NIP as APNIP',
                    'ap.ID as ID_PENGGUNA',
                    'ap.LOGIN as USERNAME',
                    'ap.PASSWORD',
                    'ap.TERAKHIR_UBAH_PASSWOD',
                    DB::raw('master.getNamaLengkapPegawai(pg.NIP) AS NAMALENGKAP'),
                    DB::raw("GROUP_CONCAT(r.name SEPARATOR ', ') as ROLE_NAMES")
                )
                ->where('ap.ID','!=','0')
                ->groupBy('ap.ID')
                ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function showRolesUser($id)
    {
        $role = Role::all();
        $user = Pengguna::find($id);
        $user_role_id = $user->roles->first()->id ?? null;
        $user_role_name = $user->roles->first()->name ?? null;

        $data = [
            'role' => $role,
            'id' => $user_role_id,
            'name' => $user_role_name,
        ];

        return response()->json($data, 200);
    }

    function updateRolesUser(Request $request)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';

        // GET USER
        $user = Pengguna::find($request->id);
        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        // GET ROLE
        $role = Role::find($request->jabatan);
        if (!$role) {
            return response()->json(['error' => 'Role tidak ditemukan'], 404);
        }

        // Ganti semua role user dengan role baru
        $user->syncRoles([$role->name]);

        // print_r($user->getRoleNames());
        // die();
        return response()->json($now, 200);
    }

    function deleteRolesUser($id)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';

        $user = Pengguna::find($id);
        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        // Hapus semua role
        $user->syncRoles([]); // <-- kosongkan semua role

        return response()->json($now, 200);
    }

}
