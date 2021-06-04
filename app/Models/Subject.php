<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $fillable = [
        'name',
    ];

    public function student() {
        return $this->hasMany(Student::class);
    }

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:m',
        'updated_at' => 'datetime:Y-m-d H:m',
    ];
}
