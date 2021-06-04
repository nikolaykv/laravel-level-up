<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Все атрибуты данной модели не должны быть назначены массово
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Обратное полиморфное отношение
    public function user()
    {
        return $this->morphOne('App\Models\User', 'profile');
    }
}
