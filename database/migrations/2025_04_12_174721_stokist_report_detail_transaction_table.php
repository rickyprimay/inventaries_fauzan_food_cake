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
        Schema::create('stokist_reports_transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stokist_report_detail_id');
            $table->unsignedBigInteger('transaction_id');
            $table->date('date');
            $table->timestamps();
        
            $table->foreign('stokist_report_detail_id', 'fk_transaction_detail_report')
                ->references('id')
                ->on('stokist_reports_detail')
                ->onDelete('cascade');
        
            $table->foreign('transaction_id', 'fk_transaction_detail_transaction')
                ->references('id')
                ->on('transactions_products')
                ->onDelete('cascade');
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
