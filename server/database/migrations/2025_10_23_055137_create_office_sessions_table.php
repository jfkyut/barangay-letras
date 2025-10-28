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
        Schema::create('office_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('council_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('office_session_types')->nullOnDelete();
            $table->string('year')->nullable();
            $table->integer('session_no');
            $table->date('date');
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_sessions');
    }
};
