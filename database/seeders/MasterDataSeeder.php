<?php

namespace Database\Seeders;

use App\Models\AssetCategory;
use App\Models\Brand;
use App\Models\Location;
use App\Models\RejectionReason;
use App\Models\TicketPriority;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $kompartemens = [
            'Kompartemen Teknologi Informasi' => [
                'Departemen Infrastruktur TI' => ['Unit Jaringan', 'Unit Server & Cloud'],
                'Departemen Pengembangan Aplikasi' => ['Unit ERP', 'Unit Aplikasi Bisnis'],
            ],
            'Kompartemen Sumber Daya Manusia' => [
                'Departemen Pendidikan & Pelatihan' => ['Unit Operasional Diklat', 'Unit Perencanaan Diklat'],
                'Departemen Personalia' => ['Unit Administrasi Karyawan', 'Unit Payroll'],
            ],
            'Kompartemen Operasi & Produksi' => [
                'Departemen Operasi Pabrik 1' => ['Unit Shift A', 'Unit Shift B'],
                'Departemen Operasi Pabrik 2' => ['Unit Kontrol', 'Unit Maintenance Dasar'],
            ],
        ];

        foreach ($kompartemens as $kompartemenName => $departemens) {
            $comp = \App\Models\Compartment::firstOrCreate(['name' => $kompartemenName], ['is_active' => true]);
            
            foreach ($departemens as $deptName => $workUnits) {
                $dept = \App\Models\Department::firstOrCreate([
                    'compartment_id' => $comp->id,
                    'name' => $deptName
                ], ['is_active' => true]);

                foreach ($workUnits as $wuName) {
                    \App\Models\WorkUnit::firstOrCreate([
                        'department_id' => $dept->id,
                        'name' => $wuName
                    ], ['is_active' => true]);
                }
            }
        }

        $categories = [
            'Komputer & Laptop',
            'Printer & Scanner',
            'Jaringan (Networking)',
            'Peralatan Produksi',
            'Kendaraan',
            'Furniture Kantor',
        ];
        foreach ($categories as $name) {
            AssetCategory::firstOrCreate(['name' => $name], ['is_active' => true]);
        }

        $brands = [
            'Lenovo',
            'HP',
            'Dell',
            'Epson',
            'Cisco',
        ];
        foreach ($brands as $name) {
            Brand::firstOrCreate(['name' => $name], ['is_active' => true]);
        }

        $locations = [
            'Gedung Pusat PKT - Lantai 1',
            'Gedung Pusat PKT - Lantai 2',
            'Gedung Pusat PKT - Lantai 3',
            'Area Pabrik',
        ];
        foreach ($locations as $name) {
            Location::firstOrCreate(['name' => $name], ['is_active' => true]);
        }

        $priorities = [
            ['name' => 'Critical', 'sla_hours' => 4],
            ['name' => 'High', 'sla_hours' => 24],
            ['name' => 'Medium', 'sla_hours' => 72],
            ['name' => 'Low', 'sla_hours' => 168],
        ];
        foreach ($priorities as $priority) {
            TicketPriority::firstOrCreate(
                ['name' => $priority['name']],
                ['sla_hours' => $priority['sla_hours'], 'is_active' => true]
            );
        }

        $reasons = [
            'Informasi tiket tidak lengkap',
            'Bukan termasuk aset yang terdaftar di sistem',
            'Duplikat dengan tiket lain yang sudah dibuat',
            'Di luar tanggung jawab divisi terkait',
            'Kerusakan sudah pernah diperbaiki sebelumnya',
        ];
        foreach ($reasons as $label) {
            RejectionReason::firstOrCreate(['label' => $label], ['is_active' => true]);
        }
    }
}