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
        Schema::create('incoming_communications', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->string('month');
            $table->string('sequence_no');
            $table->string('reference_no')->unique();
            $table->string('classification')->nullable();
            $table->longText('sender')->nullable();
            $table->longText('subject')->nullable();
            $table->string('date_received')->nullable();
            $table->longText('addressee')->nullable();
            $table->string('required_action')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_communications');
    }
};
