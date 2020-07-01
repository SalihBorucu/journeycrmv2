<?php

namespace App;

use App\Lead;
use App\Steps;
use App\Account;
use App\Campaign;
use App\Schedule;
use App\ActivityHistory;
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

    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function step(){
        return $this->belongsTo(Steps::class, 'step_id');
    }

    public function activityHistory(){
        return $this->hasOne(ActivityHistory::class);
    }
}
