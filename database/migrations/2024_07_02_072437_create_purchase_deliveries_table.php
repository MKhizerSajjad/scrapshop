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
        Schema::create('purchase_deliveries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->defaukt(1);
            $table->bigInteger('purchase_id')->unsigned();
            $table->bigInteger('lorry_id')->unsigned();
            $table->bigInteger('qty');
            $table->decimal('worth', 15, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('lorry_id')->references('id')->on('lorries')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_deliveries');
    }
};
