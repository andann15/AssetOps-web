<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignUuid('asset_category_id')->constrained('asset_categories')->restrictOnDelete();
            $table->foreignUuid('brand_id')->constrained('brands')->restrictOnDelete();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('warranty_end')->nullable();
            $table->foreignUuid('location_id')->constrained('locations')->restrictOnDelete();
            $table->string('status')->default('active');
            $table->foreignUuid('current_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};