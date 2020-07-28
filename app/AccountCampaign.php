<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCampaign extends Model
{
    protected $guarded = [];

    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
