<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'code',
        'phone',
        'address',
        'gender',
        'is_active',
        'client_type_id',
    ];

    public function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }

    public function debt()
    {
        return $this->hasMany(Debt::class);
    }

    public const ANGGOTA = 1;
    public const NASABAH = 2;
}