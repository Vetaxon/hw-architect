<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected const COUNT_OF_USERS = 100 * 1000;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(static::COUNT_OF_USERS)->create();
        \App\Models\IndexUser::factory(static::COUNT_OF_USERS)->create();
    }
}
