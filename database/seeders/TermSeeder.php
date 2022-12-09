<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 5; $i <= 60; $i++){
            Term::insert([
                [
                    'description' => $i . ' Hari',
                    'term_day' => $i
                ],
            ]);
        }
    }
}