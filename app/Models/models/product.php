<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table='products';

    public function category()
    {
        return $this->belongsTo('App\Models\models\category', 'category_id', 'id');
    }

    public function values()
    {
        return $this->belongsToMany('App\Models\models\values', 'values_products', 'product_id', 'value_id');
    }

    public function variant()
    {
        return $this->hasMany('App\Models\models\variants', 'product_id', 'id');
    }
}
