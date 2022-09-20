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
}
