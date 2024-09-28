<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        People::create(['full_name' => 'Pessoa 1',]);
        People::create(['full_name' => 'Pessoa 2',]);
    }
}
