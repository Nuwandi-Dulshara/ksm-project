<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Income;

class Donator extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * A Donator can have many Incomes
     */
    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
