<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Brand;
use App\Models\Location;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $cat = AssetCategory::firstOrCreate(['name' => 'Komputer / Laptop']);
        $brand = Brand::firstOrCreate(['name' => 'Lenovo']);
        $loc = Location::firstOrCreate(['name' => 'Gedung Pusat PKT - Lantai 3']);

        Asset::firstOrCreate(
            ['code' => 'AST-2026-001'],
            [
                'name' => 'ThinkPad T14',
                'asset_category_id' => $cat->id,
                'brand_id' => $brand->id,
                'location_id' => $loc->id,
                'status' => 'active',
            ]
        );
    }
}