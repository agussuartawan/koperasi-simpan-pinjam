<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientType;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientType::create([
            'name' => 'Anggota',
        ]);

        ClientType::create([
            'name' => 'Nasabah',
        ]);

        Client::create([
            'code' => 'AGT001',
            'name' => 'Marselina',
            'nik' => '0',
            'address' => 'Denpasar',
            'gender' => 'P',
            'phone' => '0361',
            'client_type_id' => 1
        ]);
    }
}
