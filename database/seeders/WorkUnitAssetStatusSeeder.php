<?php

namespace Database\Seeders;

use App\Models\WorkUnitAssetStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WorkUnitAssetStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Aktif Digunakan',   'slug' => 'active',      'order' => 1],
            ['name' => 'Di Gudang',          'slug' => 'in_storage',  'order' => 2],
            ['name' => 'Dalam Perbaikan',    'slug' => 'maintenance', 'order' => 3],
            ['name' => 'Rusak',              'slug' => 'damaged',     'order' => 4],
            ['name' => 'Dihapuskan',         'slug' => 'disposed',    'order' => 5],
        ];

        foreach ($statuses as $status) {
            WorkUnitAssetStatus::firstOrCreate(
                ['slug' => $status['slug']],
                ['name' => $status['name'], 'order' => $status['order'], 'is_active' => true]
            );
        }
    }
}
