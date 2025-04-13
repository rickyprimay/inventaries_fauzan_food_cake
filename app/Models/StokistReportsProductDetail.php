<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokistReportsProductDetail extends Model
{
    protected $table = 'stokist_reports_product_detail';

    protected $guarded = [];

    public function stokistReportDetail()
    {
        return $this->belongsTo(StokistReportsDetail::class, 'stokist_report_detail_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
