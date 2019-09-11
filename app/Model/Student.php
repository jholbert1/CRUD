<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'gender',
        'birthday',
        'email',
        'county',
        'city',
        'state',
        'career',
        'status',
    ];
}
