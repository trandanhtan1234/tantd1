<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table='order';

    public function customer()
    {
        return $this->belongsTo('App\Models\models\customer', 'id', 'customer_id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\models\orderdetail', 'id', 'order_id');
    }
}
