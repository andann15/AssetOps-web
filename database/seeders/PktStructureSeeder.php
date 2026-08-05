<?php

namespace Database\Seeders;

use App\Models\Compartment;
use App\Models\Department;
use App\Models\WorkUnit;
use Illuminate\Database\Seeder;

class PktStructureSeeder extends Seeder
{
    public function run(): void
    {
        $structure = [
            'Kompartemen Operasi Pabrik' => [
                'Departemen Operasi Pabrik 1A',
                'Departemen Operasi Pabrik 2',
                'Departemen Operasi Pabrik 3',
                'Departemen Operasi Pabrik 4',
                'Departemen Operasi Pabrik 5',
                'Departemen Operasi Pabrik 6 (Boiler Batubara & Utilitas Gas)',
                'Departemen Operasi Pabrik 7 (NPK)',
            ],
            'Kompartemen Pemeliharaan Pabrik' => [
                'Departemen Pemeliharaan Mechanical & Machinery',
                'Departemen Pemeliharaan Listrik dan Instalasi',
                'Departemen Pemeliharaan Instrumen',
                'Departemen Pemeliharaan Bengkel (Workshop)',
                'Departemen Perencanaan & Pengendalian TA (Turn Around / Pemeliharaan Total)',
            ],
            'Kompartemen Jasa Pelayanan Pabrik (JPP)' => [
                'Departemen Fabrikasi & Suku Cadang',
                'Departemen Pengecoran & Metalurgi',
            ],
            'Kompartemen Teknik & Keandalan Pabrik' => [
                'Departemen Rekayasa Teknik (Engineering)',
                'Departemen Keandalan Pabrik (Plant Reliability)',
                'Departemen Laboratorium Pengujian & Kalibrasi',
            ],
            'Kompartemen Pengembangan Bisnis & Investasi' => [
                'Departemen Pengembangan Bisnis',
                'Departemen Manajemen Proyek',
            ],
            'Kompartemen Tata Kelola Lingkungan & K3' => [
                'Departemen Keselamatan & Kesehatan Kerja (K3)',
                'Departemen Lingkungan Hidup',
                'Departemen Keamanan dan Ketertiban (Kamtib)',
            ],
            'Kompartemen Rantai Pasok (Supply Chain)' => [
                'Departemen Perencanaan Material dan Pergudangan',
                'Departemen Pengadaan Barang',
                'Departemen Pengadaan Jasa',
            ],
            'Kompartemen Pemasaran & Distribusi' => [
                'Departemen Pemasaran Dalam Negeri',
                'Departemen Pemasaran Luar Negeri',
                'Departemen Distribusi & Transportasi',
                'Departemen Pelayanan Pelanggan & Produk Non-Pupuk',
            ],
            'Kompartemen Keuangan' => [
                'Departemen Akuntansi',
                'Departemen Perbendaharaan & Pendanaan',
                'Departemen Anggaran & Perencanaan Keuangan',
            ],
            'Kompartemen Sumber Daya Manusia (SDM)' => [
                'Departemen Perencanaan & Pengembangan SDM',
                'Departemen Hubungan Industrial & Kesejahteraan Karyawan',
                'Departemen Pembelajaran & Sertifikasi (Diklat)',
            ],
            'Kompartemen Umum & Korporat' => [
                'Departemen Hubungan Masyarakat (Humas)',
                'Departemen Kesejahteraan & Pengelolaan Fasilitas (Umum)',
                'Departemen Tanggung Jawab Sosial dan Lingkungan (TJSL / CSR)',
            ],
            'Satuan Pengawasan Intern (SPI)' => [
                'Departemen Audit Operasional',
                'Departemen Audit Keuangan & Umum',
            ],
            'Sekretaris Perusahaan (Corporate Secretary)' => [
                'Departemen Hukum & Legal Korporat',
                'Departemen Tata Kelola Perusahaan & Kepatuhan (Governance & Compliance)',
                'Departemen Sistem Informasi dan Telekomunikasi (TI)',
                'Administrasi Korporat / Kesekretariatan',
            ],
        ];

        foreach ($structure as $compartmentName => $departments) {
            $compartment = Compartment::firstOrCreate(
                ['name' => $compartmentName],
                ['is_active' => true]
            );

            foreach ($departments as $departmentName) {
                $department = Department::firstOrCreate(
                    ['name' => $departmentName, 'compartment_id' => $compartment->id],
                    ['is_active' => true]
                );

                // Buat Unit Kerja dengan nama null karena hanya berupa Departemen
                WorkUnit::firstOrCreate(
                    ['name' => null, 'department_id' => $department->id],
                    ['is_active' => true]
                );
            }
        }
    }
}
