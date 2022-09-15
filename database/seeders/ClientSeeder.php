<?php

namespace Database\Seeders;

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
    }
}
