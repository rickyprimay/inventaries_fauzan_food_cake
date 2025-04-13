<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';

    protected $guarded = [];

    public function outlet()
    {
        return $this->belongsTo(Outlets::class);
    }

    public function deliveryDetails()
    {
        return $this->hasMany(DeliveryDetail::class);
    }

    public function fromOutlet()
    {
        return $this->belongsTo(Outlets::class, 'from_outlet_id');
    }

    public function toOutlet()
    {
        return $this->belongsTo(Outlets::class, 'to_outlet_id');
    }
}
