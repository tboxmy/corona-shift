<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    public function department()
    {
        //
        // return $this->belongsTo('App\Models\Shift', 'shift_users', 'department_id', 'shift_id');
        return $this->belongsTo('App\Models\Shift', 'shift_users');
    }
}
