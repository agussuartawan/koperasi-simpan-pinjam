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

    public static function getNextCode($clientType)
    {
        $prefix = "CLN";
        $numberPlus = 10001;
        
        if ($clientType == Client::ANGGOTA) {
            $number = Client::select("code")->where("client_type_id", Client::ANGGOTA)->orderBy("code", "desc")->first();
            $prefix = "AGT";
            if($number){
                $numberPlus = (int)substr($number->code, -5) + 1;
            }
        }
        
        if ($clientType == Client::NASABAH) {
            $number = Client::select("code")->where("client_type_id", Client::NASABAH)->orderBy("code", "desc")->first();
            $prefix = "NSB";
            if ($number) {
                $numberPlus = (int)substr($number->code, -5) + 1;
            }
        }

        return $prefix . $numberPlus;
    }

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->code = Client::getNextCode($query->client_type_id);
        });
    }

    public const ANGGOTA = 1;
    public const NASABAH = 2;
}