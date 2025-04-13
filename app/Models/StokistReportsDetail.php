<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokistReportsDetail extends Model
{
    protected $table = 'stokist_reports_detail';

    protected $guarded = [];

    public function stokistReport()
    {
        return $this->belongsTo(StokistReport::class);
    }
    public function stokist_reports_product_detail()
    {
        return $this->hasMany(StokistReportsProductDetail::class);
    }

    public function stokist_reports_deliver_detail()
    {
        return $this->hasMany(StokistReportsDeliverDetail::class);
    }

    public function stokist_reports_transaction_detail()
    {
        return $this->hasMany(StokistReportsTransactionDetail::class);
    }
    
}
