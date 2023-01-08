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
        // return $this->hasMany('App\Models\User', 'id', 'department_id');
        return $this->belongsToMany('App\Models\User', 'department_users', 'department_id', 'user_id');
    }
    public function userProfiles()
    {
        // return $this->hasMany('App\Models\User', 'id', 'department_id');
        return $this->belongsToMany('App\Models\User', 'department_users', 'department_id', 'user_id');
    }
    public function shifts()
    {
        // return $this->belongsToMany('App\Models\Shift', 'shift_users', 'shift_id', 'department_id');
        return $this->belongsToMany('App\Models\Shift', 'shift_users')->withPivot('shift_id', 'user_id');
    }
    public function managedBy()
    {
        // return $this->hasMany('App\Models\User', 'id', 'department_id');
        return $this->hasOne('App\Models\User', 'id', 'manager_id');
    }
}
