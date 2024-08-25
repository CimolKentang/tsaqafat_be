<?php

namespace Database\Seeders;

use App\Models\Biography;
use App\Models\Field;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Biography::factory(20)->create();

        Field::factory()->create([
          'name' => 'science'
        ]);
        
        Field::factory()->create([
          'name' => 'math'
        ]);

        Field::factory()->create([
          'name' => 'astronomy'
        ]);

        Field::factory()->create([
          'name' => 'liguistic'
        ]);

        Field::factory()->create([
          'name' => 'pharmacy'
        ]);
    }
}
