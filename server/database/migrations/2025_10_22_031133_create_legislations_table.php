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
        Schema::create('legislations', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->string('reference_no');
            $table->longText('author');
            $table->foreignId('type')->constrained('legislation_types');
            $table->foreignId('council_id')->nullable()->constrained('councils')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legislations');
    }
};
