<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokistReport extends Model
{
    protected $table = 'stokist_reports';

    protected $guarded = [];

    public function stokist()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function outlets()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function divisions()
    {
        return $this->belongsTo(Divisions::class, 'division_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function stokist_reports_detail()
    {
        return $this->hasMany(StokistReportsDetail::class);
    }
}
