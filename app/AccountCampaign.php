<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCampaign extends Model
{
    public function campaigns(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
