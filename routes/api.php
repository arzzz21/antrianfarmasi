<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Setting\RolesController;
use App\Http\Controllers\Setting\PermissionsController;

//-----------------------------------------------------------------    A  P  I    -----------------------------------------------------------------
Route::group(['middleware' => ['web', 'auth']], function() {
    // SETTING
        // PERMISSION x ROLES
            // PERMISSION SETTING
            Route::get('permissions/data', [PermissionsController::class, 'dataPermissions'])->name('permissions.data');
            Route::post('permissions/create', [PermissionsController::class, 'createPermissions'])->name('permissions.create');
            Route::get('permissions/{id}/show', [PermissionsController::class, 'showPermissions'])->name('permissions.show');
            Route::post('permissions/update', [PermissionsController::class, 'updatePermissions'])->name('permissions.update');
            Route::delete('permissions/{id}/delete', [PermissionsController::class, 'deletePermissions'])->name('permissions.delete');
            // ROLES SETTING
            Route::get('roles/data', [RolesController::class, 'dataRoles'])->name('roles.data');
            Route::post('roles/create', [RolesController::class, 'createRoles'])->name('roles.create');
            Route::get('roles/{id}/show', [RolesController::class, 'showRoles'])->name('roles.show');
            Route::post('roles/update', [RolesController::class, 'updateRoles'])->name('roles.update');
            Route::delete('roles/{id}/delete', [RolesController::class, 'deleteRoles'])->name('roles.delete');
            // USER ROLES SETTING
            Route::get('roles/user/data', [RolesController::class, 'dataRolesUser'])->name('roles.user.data');
            Route::get('roles/user/{id}/show', [RolesController::class, 'showRolesUser'])->name('roles.user.show');
            Route::post('roles/user/update', [RolesController::class, 'updateRolesUser'])->name('roles.user.update');
            Route::delete('roles/user/{id}/delete', [RolesController::class, 'deleteRolesUser'])->name('roles.user.delete');
});

