<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeoffType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'options',
        'updated_at',
        'created_at'
    ];
}
