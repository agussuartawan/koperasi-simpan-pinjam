<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function paymentOverdue()
    {
        return $this->hasMany(PaymentOverdue::class);
    }

    public static function getNextCode()
    {
        $number = 10001;
        $lastCode = Loan::select("code")->orderBy("code", "desc")->first();
        if ($lastCode) {
            $number = (int)substr($lastCode->code, -5) + 1;
        }

        return "PNJ" . $number;
    }

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->code = Loan::getNextCode();
        });
    }
}