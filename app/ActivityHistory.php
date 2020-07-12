<?php

namespace App;

use App\User;
use App\Account;
use App\Outcome;
use App\LeadAccount;
use Illuminate\Database\Eloquent\Model;

class ActivityHistory extends Model
{
    protected $guarded = [];

    public function outcome()
    {
        return $this->belongsTo(Outcome::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function leadAccount()
    {
        return $this->belongsTo(LeadAccount::class);
    }
}
