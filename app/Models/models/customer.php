<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table='customer';

    public function order()
    {
        return $this->hasMany('App\Models\models\order', 'id', 'customer_id');
    }
}
