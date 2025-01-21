<?php

namespace Database\Seeders;

use App\Models\People;
use Database\Factories\PeopleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeopleFactory::factoryForModel(People::class)->count(1)->create();
    }
}
