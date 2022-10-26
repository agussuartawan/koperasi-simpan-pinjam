<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'client_id', 'debt_id', 'loan_id', 'date', 'payment_on', 'mulct', 'mulct_idr', 'amount', 'total_amount'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public static function getNextCode()
    {
        $payment_count = Payment::count();
        if($payment_count == 0){
            $number = 1001;
            return 'PMB' . $number;
        } else {
            $number = Payment::all()->last();
            $number_plus = (int)substr($number->code, -4) + 1;
            return 'PMB' . $number_plus;
        }
    }
}
