<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory;
    protected $table='order_detail';

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('Order', 'id', 'order_id');
    }
}
