<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeDataDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
