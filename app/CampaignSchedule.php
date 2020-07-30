<?php

namespace App;

use App\Schedule;
use Illuminate\Database\Eloquent\Model;

class CampaignSchedule extends Model
{
    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function steps(){
        return $this->hasMany(Step::class);
    }
}
