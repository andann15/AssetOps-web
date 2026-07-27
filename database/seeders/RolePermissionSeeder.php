<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Aset
            'assets.view',
            'assets.create',
            'assets.edit',
            'assets.delete',

            // Tiket
            'tickets.view-all',
            'tickets.view-own',
            'tickets.create',
            'tickets.assign',
            'tickets.approve',
            'tickets.reject',
            'tickets.update-status',
            'tickets.close',
            'tickets.cancel',

            // User & Divisi
            'users.manage',
            'divisions.manage',

            // Audit & Laporan
            'audit-logs.view',
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        $operator = Role::firstOrCreate(['name' => 'operator', 'guard_name' => 'web']);
        $operator->syncPermissions([
            'assets.view',
            'tickets.view-all',
            'tickets.update-status',
            'reports.view',
        ]);

        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $user->syncPermissions([
            'assets.view',
            'tickets.view-own',
            'tickets.create',
            'tickets.close',
            'tickets.cancel',
        ]);
    }
}