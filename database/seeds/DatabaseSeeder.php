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
            GroupSeeder::class
        ]);

        factory(App\Models\Student::class, 5)->create()->each(function ($student) {
            // Полиморфные отношения
            $student->user()->save(
                factory(App\Models\User::class)->make([
                    'profile_id' => $student->id,
                    'profile_type' => App\Models\User::class
                ])
            );

            // отношения один к одному
            $student->subject()->save(
                factory(App\Models\Subject::class)->make([
                    'student_id' => $student->id
                ])
            );
        });

    }
}
