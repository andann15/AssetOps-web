<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('asset_id')->constrained('assets')->restrictOnDelete();
            $table->foreignUuid('created_by')->constrained('users')->restrictOnDelete();
            $table->text('description');
            $table->string('photo_url');
            $table->string('proof_photo_url')->nullable();
            $table->foreignUuid('ticket_priority_id')->nullable()->constrained('ticket_priorities')->nullOnDelete();
            $table->string('status')->default('waiting_approval');
            $table->foreignUuid('assigned_operator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('sla_deadline')->nullable();
            $table->boolean('sla_breached')->default(false);
            $table->foreignUuid('rejection_reason_id')->nullable()->constrained('rejection_reasons')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};