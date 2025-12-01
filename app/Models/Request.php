<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'category',
        'remarks',
        'lat',
        'lng',
        'status',
        'donor_name',
    ];

    //
}
