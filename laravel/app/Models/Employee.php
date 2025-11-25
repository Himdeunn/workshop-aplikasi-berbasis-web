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
        'date_entry',
        'status',
        'department_id',
        'position_id',
        'user_id',
    ];

    // 🔹 Employee belongs to one Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // 🔹 Employee belongs to one Position
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // 🔹 Employee has many Attendance records
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // 🔹 Employee has many Salary records
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
