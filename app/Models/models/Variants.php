<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;
    protected $table='variant';

    public $timestamps = false;

    public function values()
    {
        return $this->belongsToMany('App\Models\models\Values', 'variant_value', 'variant_id', 'value_id');
    }
}
