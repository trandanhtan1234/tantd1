<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Values extends Model
{
    use HasFactory;
    protected $table = 'values';

    public $timestamps = false;
    
    public function product()
    {
        return $this->belongsToMany('App\Models\models\Product', 'value_id', 'product_id');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\models\Attributes', 'attr_id', 'id');
    }
}
