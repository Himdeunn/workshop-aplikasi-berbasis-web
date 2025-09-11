<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'birth_date',
        'address',
        'data_entry',
        'status',
    ];
}
