<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@pkt.id'],
            ['nik' => 'ADM001', 'name' => 'Admin AdKor', 'role' => 'admin', 'password' => 'secret']
        );
        $admin->assignRole('admin');

        $operator = User::firstOrCreate(
            ['email' => 'op@pkt.id'],
            ['nik' => 'OP001', 'name' => 'Operator IT', 'role' => 'operator', 'password' => 'secret']
        );
        $operator->assignRole('operator');

        $user = User::firstOrCreate(
            ['email' => 'user@pkt.id'],
            ['nik' => 'USR001', 'name' => 'Karyawan PKT', 'role' => 'user', 'password' => 'secret']
        );
        $user->assignRole('user');
    }
}