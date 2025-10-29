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
        Schema::create('office_session_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->longText('file_path');
            $table->foreignId('type_id')->nullable()->constrained('attachment_types')->nullOnDelete();
            $table->foreignId('session_id')->constrained('office_sessions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_session_attachments');
    }
};
