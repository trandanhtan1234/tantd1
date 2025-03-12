<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table='customer';
    protected $fillable = [
        'email',
        'password',
        'full',
        'address',
        'phone'
    ];

    protected $hidden = [
        'password'
    ];

    public function order()
    {
        return $this->hasMany('App\Models\models\Order', 'id', 'customer_id');
    }
}
