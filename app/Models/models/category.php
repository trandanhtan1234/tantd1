<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table='category';

    public $timestamps = false;

    public function product()
    {
        return $this->hasMany('App\Models\models\product', 'category_id', 'id');
    }
}
