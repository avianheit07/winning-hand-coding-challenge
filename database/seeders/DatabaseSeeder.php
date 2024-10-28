<?php

namespace Database\Seeders;

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

        User::updateOrCreate([
            'email' => 'test@example.com'
        ],
        [
            'first_name'        => 'Test',
            'last_name'        => 'Name',
            'email_verified_at' => now(),
            'password'         => bcrypt('Qwer1234')
        ]);

        $this->call(UserTypesTableSeeder::class);
    }
}
