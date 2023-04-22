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
        Schema::create('country_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreign('code')->references('code')->on('country_codes');
            $table->string('country');
            $table->json('name');
            $table->integer('new_cases');
            $table->integer('recovered');
            $table->integer('deaths');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_statistics');
    }
};
