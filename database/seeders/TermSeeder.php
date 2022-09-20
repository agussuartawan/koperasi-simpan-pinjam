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
        Term::insert([
            [
                'description' => '1 Hari',
                'term_day' => 1
            ],
            [
                'description' => '2 Hari',
                'term_day' => 2
            ],
            [
                'description' => '3 Hari',
                'term_day' => 3
            ],
            [
                'description' => '4 Hari',
                'term_day' => 4
            ],
        ]);
    }
}
