<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'donator_id',
        'amount',
        'invoice_number',
        'received_date',
        'description',
        'attachment',
    ];

    public function donator()
    {
        return $this->belongsTo(Donator::class);
    }
}
