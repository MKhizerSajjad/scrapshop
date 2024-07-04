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
        Schema::create('sale_deliveries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status');
            $table->bigInteger('sale_id')->unsigned();
            $table->bigInteger('lorry_id')->unsigned();
            $table->bigInteger('qty');
            $table->decimal('worth', 15, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('lorry_id')->references('id')->on('lorries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_deliveries');
    }
};
