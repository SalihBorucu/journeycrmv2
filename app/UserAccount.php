<?php

namespace App;

use App\User;
use App\Account;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $guarded = [];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
