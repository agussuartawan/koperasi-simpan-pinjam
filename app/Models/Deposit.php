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

    public const SIMPANAN_WAJIB = 1;
    public const SIMPANAN_POKOK = 2;
    public const SIMPANAN_SUKARELA = 3;
}
