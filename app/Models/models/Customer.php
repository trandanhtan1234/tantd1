<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
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
    
    public function getJWTIdentifier()
    {
        return $this->getKey(); // This returns the primary key (ID) of the customer
    }

    public function getJWTCustomClaims()
    {
        return []; // You can add extra claims if needed
    }
}
