<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    protected $table = 'attributes';

    public $timestamps = false;

    public function values()
    {
        return $this->hasMany('App\Models\models\Values', 'attr_id', 'id');
    }
}
