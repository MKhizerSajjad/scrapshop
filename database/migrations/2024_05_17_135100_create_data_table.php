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
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->tinyInteger('status');
            $table->date('date');
            $table->bigInteger('code');
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
            $table->string('personal_situation', 255);
            $table->string('specific_issues', 255);
            $table->string('use_for', 255);
            $table->string('outcomes', 255);
            $table->longText('note')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('users')->onDelete('CASCADE');
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
