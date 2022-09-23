<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrear extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'installment_to'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
