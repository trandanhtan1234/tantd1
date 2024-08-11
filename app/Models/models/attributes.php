<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributes extends Model
{
    use HasFactory;
    protected $table = 'attributes';

    public $timestamps = false;

    public function values()
    {
        return $this->hasMany('App\Models\models\values', 'attr_id', 'id');
    }
}
