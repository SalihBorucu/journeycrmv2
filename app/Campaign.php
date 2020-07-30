<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    public function campaignSchedules()
    {
        return $this->hasMany(CampaignSchedule::class);
    }
}
