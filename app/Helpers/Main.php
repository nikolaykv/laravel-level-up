<?php

namespace App\Helpers;

use App\Models\User;

class Main {
    public static function getStudentsByFullName($data) {
        $users = array();
        foreach ($data as $student) {
            $userData = explode(' ', $student);
            array_push($users, User::where('name', '=', $userData[0])
                ->where('surname', '=', $userData[1])
                ->get());
        }
        return $users;
    }
}
