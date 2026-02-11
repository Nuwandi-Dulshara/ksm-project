<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'total_donated',
    ];
}
