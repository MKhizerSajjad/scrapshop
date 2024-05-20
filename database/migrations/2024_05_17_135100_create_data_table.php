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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status');
            $table->dateTime('date_time');
            $table->string('code', 255);
            $table->string('identifier', 255);
            $table->tinyInteger('channel');
            $table->tinyInteger('call_type');
            $table->tinyInteger('age_band');
            $table->tinyInteger('gender');
            $table->tinyInteger('sexuality');
            $table->string('diagnoses', 255);
            $table->string('triggers', 255);
            $table->string('self_harm_method', 255);
            $table->tinyInteger('contact_type');
            $table->integer('location');
            $table->tinyInteger('service_awareness');
            $table->boolean('other_involved_services');
            $table->tinyInteger('personal_situation');
            $table->tinyInteger('specific_issues');
            $table->tinyInteger('use_for');
            $table->tinyInteger('outcomes');
            $table->longText('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
