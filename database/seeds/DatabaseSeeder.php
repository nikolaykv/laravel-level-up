<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            GroupSeeder::class,
            GradeSeeder::class,
        ]);

        factory(\App\Models\Student::class, 5)->create();
    }
}
