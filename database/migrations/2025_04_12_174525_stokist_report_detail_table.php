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
        Schema::create('stokist_reports_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stokist_report_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('stokist_report_id')->references('id')->on('stokist_reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
