<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [];

        for ($i = 1; $i <= 5; $i++) {
            $name = 'Учебная группа №' . $i;

            $groups[] = [
                'name' => $name
            ];
        }

        DB::table('groups')->insert($groups);
    }
}
