<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model
{
    use HasFactory;
    protected $table='orderdetail';

    public function order()
    {
        return $this->belongsTo('order', 'id', 'order_id');
    }
}
