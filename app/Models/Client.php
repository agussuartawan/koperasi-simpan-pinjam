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

    public static function getNextCode($client_type)
    {
        $client_count = Client::where('client_type_id', $client_type)->count();
        $prefix = '';
        $firstNumber = 1001;

        if($client_type == Client::ANGGOTA){
            $prefix = 'AGT';
        }
        if($client_type == Client::NASABAH){
            $prefix = 'NSB';
        }

        if($client_count == 0){
            return $prefix . $firstNumber;
        } else {
            $nextNumber = Client::where('client_type_id', $client_type)->orderBy('code', 'desc')->first();
            $number_plus = (int)substr($nextNumber->code, -4) + 1;
            return $prefix . $number_plus;
        }
    }

    public const ANGGOTA = 1;
    public const NASABAH = 2;
}
