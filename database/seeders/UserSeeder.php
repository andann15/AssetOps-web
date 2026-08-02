<?php

namespace Database\Seeders;

use App\Models\WorkUnit;
use App\Models\WorkUnitHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $itUnit = WorkUnit::where('name', 'Unit Server & Cloud')->first();
        $maintenanceUnit = WorkUnit::where('name', 'Unit Maintenance Dasar')->first();
        $produksiUnit = WorkUnit::where('name', 'Unit Shift A')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@pkt.id'],
            [
                'nik' => 'ADM-2026-001',
                'name' => 'Admin AdKor',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'work_unit_id' => $itUnit->id ?? null,
                'login_pertama' => false,
            ]
        );
        $admin->assignRole('admin');
        if ($itUnit) $this->recordWorkUnitHistory($admin, $itUnit, $admin);

        $operator = User::firstOrCreate(
            ['email' => 'operator@pkt.id'],
            [
                'nik' => 'OPS-2026-001',
                'name' => 'Operator Maintenance',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'work_unit_id' => $maintenanceUnit->id ?? null,
                'login_pertama' => false,
            ]
        );
        $operator->assignRole('operator');
        if ($maintenanceUnit) $this->recordWorkUnitHistory($operator, $maintenanceUnit, $admin);

        $employee = User::firstOrCreate(
            ['email' => 'karyawan@pkt.id'],
            [
                'nik' => 'USR-2026-001',
                'name' => 'Karyawan Produksi',
                'password' => Hash::make('password'),
                'role' => 'user',
                'work_unit_id' => $produksiUnit->id ?? null,
                'login_pertama' => false,
            ]
        );
        $employee->assignRole('user');
        if ($produksiUnit) $this->recordWorkUnitHistory($employee, $produksiUnit, $admin);
    }

    private function recordWorkUnitHistory(User $user, WorkUnit $unit, User $actor): void
    {
        WorkUnitHistory::create([
            'user_id' => $user->id, 
            'to_work_unit_id' => $unit->id, 
            'changed_by' => $actor->id, 
            'reason' => 'Initial assign'
        ]);
    }
}