<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ ADD THIS

class Expense extends Model
{
    use HasFactory; // ✅ Now it works

    protected $fillable = [
        'date',
        'title',
        'expense_type',
        'category_id',
        'employee_id',
        'freelancer_id',
        'beneficiary_id',
        'paid_to',
        'status',
        'amount',
        'receipt'
    ];
}
