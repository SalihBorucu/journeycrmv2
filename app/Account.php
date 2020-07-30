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

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function accountLeads()
    {
        return $this->hasMany(LeadAccount::class);
    }
}
