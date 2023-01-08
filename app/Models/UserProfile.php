<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function departments()
    {
        return $this->belongsToMany('App\Models\Department', 'department_users', 'user_id', 'department_id');
    }
}
