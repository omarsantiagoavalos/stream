<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    protected $fillable = [
        'id_employee',
        'name',
        'gender',
        'image',
        'streaming_key',
        'status',
    ];
}
