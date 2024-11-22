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
        Schema::create('service_spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('space_id')->constrained('spaces')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_spaces');
    }
};
