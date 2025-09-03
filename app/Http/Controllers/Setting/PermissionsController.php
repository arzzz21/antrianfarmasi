<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Pengguna;
use Carbon\Carbon;
use DB;

class PermissionsController extends Controller
{
    function index()
    {
        $show = '';

        $data = [
            'show' => $show,
        ];

        return view('pages.setting.permissions')->with('list', $data);
    }

    function dataPermissions()
    {
        $show = Permission::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function createPermissions(Request $request)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';
        $show = Permission::create(['name' => $request->akses, 'guard_name' => 'web']);

        return response()->json($now, 200);
    }

    function showPermissions($id)
    {
        $show = Permission::all();

        // Ambil role berdasarkan role_id
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role tidak ditemukan'], 404);
        }

        // print_r($role->permissions);
        // die();
        $data = [
            'role' => $role,
            'permissions' => $role->permissions,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function updatePermissions(Request $request)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';
        $roleId = $request->id;
        $permissionIds = json_decode($request->akses_jabatan); // decode JSON array

        // Ambil Role dari koneksi db_custom
        $role = Role::on('db_custom')->find($roleId);

        if (!$role) {
            return response()->json(['error' => 'Role tidak ditemukan.'], 404);
        }

        // Ambil nama permission berdasarkan ID dari db_custom
        $permissionNames = DB::connection('db_custom')
            ->table('permissions')
            ->whereIn('id', $permissionIds)
            ->pluck('name')
            ->toArray();

        // Sinkronisasi permission ke role
        $role->syncPermissions($permissionNames);

        return response()->json($now, 200);
    }

    function deletePermissions($id)
    {
        $now = Carbon::now()->translatedFormat('l, j F Y \P\u\k\u\l H:i') . ' WIB';

        // Ambil permission dari koneksi yang sesuai (db_custom)
        $permission = DB::connection('db_custom')->table('permissions')->find($id);
        if (!$permission) {
            return response()->json(['error' => 'Akses tidak ditemukan'], 404);
        }

        // 1. Hapus relasi permission dari semua role (pivot: role_has_permissions)
            // $permission->roles()->detach();

        // 2. Hapus relasi langsung ke user dari tabel terkait secara manual
                // Hapus relasi dari role_has_permissions
                DB::connection('db_custom')->table('role_has_permissions')
                    ->where('permission_id', $id)
                    ->delete();

                // Hapus relasi dari model_has_permissions
                DB::connection('db_custom')->table('model_has_permissions')
                    ->where('permission_id', $id)
                    ->delete();

                // Hapus permission dari tabel permissions
                DB::connection('db_custom')->table('permissions')
                    ->where('id', $id)
                    ->delete();

        // 3. Hapus record dari tabel permissions
            // $permission->delete();

        return response()->json($now, 200);
    }
}
