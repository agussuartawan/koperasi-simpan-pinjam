<?php

namespace Database\Seeders;

use App\Models\DepositType;
use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepositType::create([
            'name' => 'Simpanan Wajib',
        ]);

        DepositType::create([
            'name' => 'Simpanan Pokok',
        ]);

        DepositType::create([
            'name' => 'Simpanan Sukarela',
        ]);
    }
}
