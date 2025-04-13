<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
