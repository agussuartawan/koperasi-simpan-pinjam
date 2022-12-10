<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'date', 'deposit_type_id', 'amount', 'description'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function depositType()
    {
        return $this->belongsTo(DepositType::class);
    }

    public static function getNextCode()
    {
        $number = 10001;
        $lastCode = Deposit::select("code")->orderBy("code", "desc")->first();
        if ($lastCode){
            $number = (int)substr($lastCode->code, -5) + 1;
        }

        return "STR" . $number;
    }

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->code = Deposit::getNextCode();
        });
    }

    public const SIMPANAN_WAJIB = 1;
    public const SIMPANAN_POKOK = 2;
    public const SIMPANAN_SUKARELA = 3;
}