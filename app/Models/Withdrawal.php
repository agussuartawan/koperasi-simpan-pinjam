<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'deposit_balance_id', 'date', 'amount', 'description'];

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
        $number = 10001;
        $lastCode = Withdrawal::select("code")->orderBy("code", "desc")->first();
        if ($lastCode) {
            $number = (int)substr($lastCode->code, -5) + 1;
        }

        return "TRK" . $number;
    }

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->code = Withdrawal::getNextCode();
        });
    }
}