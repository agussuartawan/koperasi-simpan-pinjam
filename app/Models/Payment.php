<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'debt_id', 'loan_id', 'date', 'payment_on', 'mulct', 'mulct_idr', 'amount', 'total_amount'];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getNextCode()
    {
        $number = 10001;
        $lastCode = Payment::select("code")->orderBy("code", "desc")->first();
        if ($lastCode) {
            $number = (int)substr($lastCode->code, -5) + 1;
        }

        return "PMB" . $number;
    }

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->user_id = auth()->user()->id;
            $query->code = Payment::getNextCode();
        });
    }
}