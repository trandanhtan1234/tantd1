<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='category';

    public $timestamps = false;

    public function product()
    {
        return $this->hasMany('App\Models\models\Product', 'category_id', 'id');
    }
}
