<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(UserAccount::class);
    }

    public function accountCampaigns()
    {
        return $this->hasMany(AccountCampaign::class);
    }
}
