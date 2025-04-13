<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokistReportsTransactionDetail extends Model
{
    protected $table = 'stokist_reports_transaction_detail';

    protected $guarded = [];

    public function stokistReportDetail()
    {
        return $this->belongsTo(StokistReportsDetail::class, 'stokist_report_detail_id');
    }

    public function transactions()
    {
        return $this->belongsTo(TransactionsProducts::class, 'transaction_id');
    }
}
