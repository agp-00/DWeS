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
            $table->string('observation_CA',100)->nullable();
            $table->string('observation_ES',100)->nullable();
            $table->string('observation_EN',100)->nullable();
            $table->string('email',100);
            $table->string('phone',100);
            $table->string('website',100);
            $table->string('accessType',1);
            $table->double('totalScore');
            $table->double('countStore');
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
