<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'client_id', 'debt_id', 'loan_id', 'date', 'payment_on', 'mulct', 'amount'];
}
