<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOverdue extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'installment_to', 'overdue_date'];
}
