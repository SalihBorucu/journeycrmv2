<?php

namespace App;

use App\LeadAccount;
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

    public function accountLeads()
    {
        return $this->hasMany(LeadAccount::class);
    }
}
