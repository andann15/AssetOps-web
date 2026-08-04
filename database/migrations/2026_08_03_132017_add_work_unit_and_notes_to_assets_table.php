<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->foreignUuid('work_unit_id')->nullable()->after('current_user_id')->constrained('work_units')->nullOnDelete();
            $table->text('notes')->nullable()->after('work_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['work_unit_id']);
            $table->dropColumn(['work_unit_id', 'notes']);
        });
    }
};
