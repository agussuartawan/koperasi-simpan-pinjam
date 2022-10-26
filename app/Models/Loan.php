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
        'total_amount',
        ''
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function paymentOverdue()
    {
        return $this->hasMany(PaymentOverdue::class);
    }

    public static function getNextCode()
    {
        $loan_count = Loan::count();
        if($loan_count == 0){
            $number = 1001;
            return 'PNJ' . $number;
        } else {
            $number = Loan::all()->last();
            $number_plus = (int)substr($number->code, -4) + 1;
            return 'PNJ' . $number_plus;
        }
    }
}
