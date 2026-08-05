<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_unit_asset_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');        // Label tampil: "Aktif Digunakan"
            $table->string('slug')->unique(); // Kunci tersimpan: "aktif_digunakan"
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_unit_asset_statuses');
    }
};
