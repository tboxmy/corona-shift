<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // public function departmentUser()
    // {
    //     return $this->belongsToMany('App\Models\DepartmentUsers', 'department_id');
    // }
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'department_users', 'user_id', 'department_id');
    }
}
