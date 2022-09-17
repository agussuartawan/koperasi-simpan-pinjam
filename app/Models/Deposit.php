<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'client_id', 'date', 'deposit_type', 'amount'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
