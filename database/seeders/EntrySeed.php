<?php

namespace Database\Seeders;

use App\Models\Entry;
use Database\Factories\EntryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntrySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EntryFactory::factoryForModel(Entry::class)->count(2)->create();
    }
}
