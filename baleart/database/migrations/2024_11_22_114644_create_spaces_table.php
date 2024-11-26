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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('regNumber', 100)->unique();
            $table->text('observation_CA')->nullable();
            $table->text('observation_ES')->nullable();
            $table->text('observation_EN')->nullable();
            $table->string('email',100);
            $table->string('phone',100);
            $table->string('website',100);
            $table->enum('accessType',['y', 'n', 'p']);
            $table->double('totalScore');
            $table->double('countScore');
            $table->foreignId('address_id')->constrained('addresses')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('space_type_id')->constrained('space_types')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropForeign(['space_type_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('spaces');
    }
};
