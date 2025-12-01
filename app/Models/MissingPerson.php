<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissingPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'last_seen_location',
        'description',
        'image_path',
        'contact_name',
        'contact_phone',
        'contact_phone_2',
        'status',
    ];
}
