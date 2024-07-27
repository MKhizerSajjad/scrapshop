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
        Schema::create('lorries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status');
            $table->string('name');
            $table->string('nric')->nullable();
            $table->string('phone')->nullable();
            $table->string('plate_number');
            $table->string('capacity');
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lorries');
    }
};
