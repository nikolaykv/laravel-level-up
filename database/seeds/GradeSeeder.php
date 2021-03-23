<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [];

        for ($i = 1; $i <= 5; $i++) {
            $name = 'Название предмета №' . $i;

            $grades[] = [
                'name' => $name,
                'value' => mt_rand(1, 5),
            ];
        }

        DB::table('grades')->insert($grades);
    }
}
