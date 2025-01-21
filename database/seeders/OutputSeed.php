<?php

namespace Database\Seeders;

use App\Models\Output;
use Database\Factories\OutputFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutputSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OutputFactory::factoryForModel(Output::class)->count(5)->create();
    }
}
