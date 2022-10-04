<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'client_id', 'date', 'deposit_type_id', 'amount', 'description'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function depositType()
    {
        return $this->belongsTo(DepositType::class);
    }

    public static function nextCode()
    {
        $deposit_count = Deposit::count();
        if($deposit_count == 0){
            $number = 1001;
            return 'STRN' . $number;
        } else {
            $number = Deposit::all()->last();
            $number_plus = (int)substr($number->code, -4) + 1;
            return 'STRN' . $number_plus;
        }
    }

    public const SIMPANAN_WAJIB = 1;
    public const SIMPANAN_POKOK = 2;
    public const SIMPANAN_SUKARELA = 3;
}
