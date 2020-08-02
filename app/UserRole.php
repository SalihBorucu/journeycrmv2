<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $guarded = [];

    function user(){
        return $this->hasMany(User::class, 'user_role_id');
    }
}
