<?php

namespace App;

use App\Lead;
use App\Account;
use Illuminate\Database\Eloquent\Model;

class LeadAccount extends Model
{
    protected $guarded = [];

    public function lead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function account(){
        return $this->belongsTo(Account::class, 'account_id');
    }
}
