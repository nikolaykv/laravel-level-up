<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Group extends Model
{
    protected $fillable = [
        'name',
    ];

   public function students()
   {
       return $this->hasMany(Student::class);
   }
    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:m',
        'updated_at' => 'datetime:Y-m-d H:m',
    ];
}
