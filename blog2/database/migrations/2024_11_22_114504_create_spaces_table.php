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
            $table->string('name', 100)->nullable();
            $table->string('regNumber', 100)->unique();
            $table->string('observation_CA',100)->nullable();
            $table->string('observation_ES',100)->nullable();
            $table->string('observation_EN',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('website',100)->nullable();
            $table->string('accessType',1)->nullable();
            $table->number('totalScore')->nullable();
            $table->number('countStore')->nullable();
            $table->foreignId('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreignId('space_type_id')->references('id')->on('space_types')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};