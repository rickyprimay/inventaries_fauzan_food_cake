<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokistReportsDeliverDetail extends Model
{
    protected $table = 'stokist_reports_deliver_detail';

    protected $guarded = [];

    public function stokistReportDetail()
    {
        return $this->belongsTo(StokistReportsDetail::class, 'stokist_report_detail_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'deliveries_id');
    }
}
