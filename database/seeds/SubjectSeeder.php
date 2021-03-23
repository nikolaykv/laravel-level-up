<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [];

        for ($i = 1; $i <= 5; $i++) {
            $name = 'Название предмета №' . $i;

            $subjects[] = [
                'name' => $name,
                'value' => rand(1, 5),
                'student_id' => factory('App\Models\Student')->create()->id,
            ];
        }

        DB::table('subjects')->insert($subjects);
    }
}
