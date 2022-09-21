<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'client_id',
        'date',
        'bank_interest',
        'bank_interest_idr',
        'term_id',
        'amount',
        'total_amount'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
