<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_unit_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('from_work_unit_id')->nullable();
            $table->uuid('to_work_unit_id')->nullable();
            $table->uuid('changed_by')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_work_unit_id')->references('id')->on('work_units')->onDelete('set null');
            $table->foreign('to_work_unit_id')->references('id')->on('work_units')->onDelete('set null');
            $table->foreign('changed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_unit_histories');
    }
};
