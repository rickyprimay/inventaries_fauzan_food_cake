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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_outlet_id');
            $table->unsignedBigInteger('to_outlet_id');
            $table->date('send_date');
            $table->enum('send_status', ['pending', 'dikirim', 'diterima'])->default('pending');
            $table->timestamps();

            $table->foreign('from_outlet_id')->references('id')->on('outlets')->onDelete('cascade');
            $table->foreign('to_outlet_id')->references('id')->on('outlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
