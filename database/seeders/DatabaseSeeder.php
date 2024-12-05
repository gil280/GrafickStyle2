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
        $this->call(RoleSeeder::class);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Gildardo',
            'email' => 'garciareyesgildardo@gmail.com',
            ])->assignRole('Administrador');

            User::factory()->create([
                'name' => 'Emmanuel',
                'email' => 'Emmanuel@gmail.com',
            ])->assignRole('Editor');
            
            User::factory(5)->create()->each(function ($user) {
                $user->assignRole('Usuario');
            });
        

        Extras::factory(20)->create();
        Playeras::factory(20)->create();
        Pulsera::factory(20)->create();
        Sudadera::factory(20)->create();
        Taza::factory(20)->create();
        Termo::factory(20)->create();
    

    }
}
