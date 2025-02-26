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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->foreignId('municipality_id')->constrained('municipalities')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('zone_id')->constrained('zones')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['zone_id']);
        });

        Schema::dropIfExists('addresses');
    }
};
