<?php

namespace App;

use App\User;
use App\Account;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $guarded = [];

    // public $timestamps = false;

    public function account(){
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function accountUsers()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // public function characteristics()
    // {
    //     return $this->belongsTo(TransformerPreset::class, 'transformer_preset_id');
    // }
}
