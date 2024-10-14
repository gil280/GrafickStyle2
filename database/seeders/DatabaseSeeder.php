<?php

namespace Database\Seeders;

use App\Models\Extras;
use App\Models\Playeras;
use App\Models\Pulsera;
use App\Models\Sudadera;
use App\Models\Taza;
use App\Models\Termo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Gildardo',
            'email' => 'garciareyesgildardo@gmail.com',
        ]);

        Extras::factory(100)->create();
        Playeras::factory(100)->create();
        Pulsera::factory(100)->create();
        Sudadera::factory(100)->create();
        Taza::factory(100)->create();
        Termo::factory(100)->create();
    

    }
}
