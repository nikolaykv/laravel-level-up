<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:m',
        'updated_at' => 'datetime:Y-m-d H:m',
    ];
}
