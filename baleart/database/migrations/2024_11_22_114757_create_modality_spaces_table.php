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
        Schema::create('modality_spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modality_id')->constrained('modalities')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('space_id')->constrained('spaces')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropForeign(['modality_id']);
            $table->dropForeign(['space_id']);
        });

        Schema::dropIfExists('modality_spaces');
    }
};
