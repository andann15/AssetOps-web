<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\DivisionHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $itDivision = Division::where('name', 'IT & Sistem Informasi')->first();
        $maintenanceDivision = Division::where('name', 'Pemeliharaan (Maintenance)')->first();
        $produksiDivision = Division::where('name', 'Produksi')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@pkt.id'],
            [
                'nik' => 'ADM-2026-001',
                'name' => 'Admin AdKor',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'division_id' => $itDivision->id,
                'login_pertama' => false,
            ]
        );
        $admin->assignRole('admin');
        $this->recordDivisionHistory($admin, $itDivision, $admin);

        $operator = User::firstOrCreate(
            ['email' => 'operator@pkt.id'],
            [
                'nik' => 'OPS-2026-001',
                'name' => 'Operator Maintenance',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'division_id' => $maintenanceDivision->id,
                'login_pertama' => false,
            ]
        );
        $operator->assignRole('operator');
        $this->recordDivisionHistory($operator, $maintenanceDivision, $admin);

        $employee = User::firstOrCreate(
            ['email' => 'karyawan@pkt.id'],
            [
                'nik' => 'USR-2026-001',
                'name' => 'Karyawan Produksi',
                'password' => Hash::make('password'),
                'role' => 'user',
                'division_id' => $produksiDivision->id,
                'login_pertama' => false,
            ]
        );
        $employee->assignRole('user');
        $this->recordDivisionHistory($employee, $produksiDivision, $admin);
    }

    private function recordDivisionHistory(User $user, Division $division, User $actor): void
    {
        DivisionHistory::firstOrCreate(
            ['user_id' => $user->id, 'division_id' => $division->id, 'ended_at' => null],
            ['changed_by' => $actor->id, 'started_at' => now()]
        );
    }
}