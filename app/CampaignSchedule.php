<?php

namespace App;

use App\Schedule;
use App\Campaign;
use Illuminate\Database\Eloquent\Model;

class CampaignSchedule extends Model
{
    protected $guarded = [];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
