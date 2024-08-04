<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class values extends Model
{
    use HasFactory;
    protected $table = 'values';
    
    public function product()
    {
        return $this->belongsToMany('App\Models\models\product', 'value_id', 'product_id');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\models\attributes', 'attr_id', 'id');
    }
}
