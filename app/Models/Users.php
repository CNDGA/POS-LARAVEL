<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'level_id'
    ];

    public function levels()
    {
        return $this->belongsTo(Levels::class, 'level_id', 'id');
    }
}
