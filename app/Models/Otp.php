<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject; 

class Otp  extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'graphql_otps';
    protected $fillable = [
        'account_code',
        'mobile_number',
        'device_id',
        'status'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
   
}
