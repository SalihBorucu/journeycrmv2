<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //

    protected $guarded = [];

    public function leadAccounts(){
        return $this->hasMany(LeadAccount::class);
    }
}
