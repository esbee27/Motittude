<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    //Super admin model
    protected $guard = 'admin';
    protected $fillable = ['username', 'password'];

}
