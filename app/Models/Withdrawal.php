<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'deposit_balance_id', 'date', 'amount', 'code', 'description'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public static function getNextCode()
    {
        $deposit_count = Withdrawal::count();
        if($deposit_count == 0){
            $number = 1001;
            return 'TRK' . $number;
        } else {
            $number = Withdrawal::all()->last();
            $number_plus = (int)substr($number->code, -4) + 1;
            return 'TRK' . $number_plus;
        }
    }
}
