<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='order';

    public function customer()
    {
        return $this->belongsTo('App\Models\models\Customer', 'customer_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\models\Orderdetail', 'id', 'order_id');
    }
}
