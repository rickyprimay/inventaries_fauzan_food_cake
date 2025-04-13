<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsProducts extends Model
{
    protected $table = 'transactions_products';

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function outlets()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }
}
