<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogData extends Model
{
    use HasFactory;
    protected $table='log_data';
    protected $fillable=[
        'customer_id',
        'request_values',
        'response_values',
        'api_file'
    ];
}
