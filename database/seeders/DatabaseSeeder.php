<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Profile::factory()->create([
            'user_id' => 1,
        ]);
        Profile::factory()->create([
            'user_id' => 2,
        ]);
        Profile::factory(8)->create();
    }
}
