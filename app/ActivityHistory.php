<?php

namespace App;

use App\Step;
use App\User;
use App\Account;
use App\Outcome;
use App\LeadAccount;
use App\QueryFilter;
use App\CampaignSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivityHistory extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($activityHistory) {
            $activityHistory->adjustLeadAccountRecord($activityHistory);
        });
    }

    public function adjustLeadAccountRecord($activityHistory)
    {
        $outcome = Outcome::find(request('outcome'));
        $nextSchedule = $outcome->new_schedule_id ? $outcome->new_schedule_id :  request('lead.schedule_id'); //4
        $previousScheduleId = request('lead.schedule_id');
        $previousStepNumber = request('lead.step.step_number');


        if ($outcome->new_schedule_id) {
            $campaignScheduleId = CampaignSchedule::where([['schedule_id', $outcome->new_schedule_id], ['campaign_id', request('lead.campaign_id')]])->first()->id;
            $nextStep = Step::where('campaign_schedule_id', $campaignScheduleId)
            ->where('step_number', 1)
            ->first()->id;
            $nextDueDate = request('lead.due_date');
            $nextStatus = request('lead.current_status');

            // if new schedule is custom
            if (request('outcome') === "3") {
                $nextDueDate = request('custom_activity_date');
                $nextStep = Step::where('schedule_id', $outcome->new_schedule_id)
                ->where('type', request('custom_activity_type'))
                ->first()->id;
            }
        } else {

            $lastSchedule = request('lead.schedule_id');
            $lastStepNumber = request('lead.step.step_number');

            //When previous activity was custom
            if (request('lead.schedule_id') === 6) {
                $lastSchedule = request('lead.previous_schedule_id');
                $lastStepNumber = request('lead.previous_step_number');
            }

            $nextStep = Step::where('schedule_id', $lastSchedule)
            ->where('step_number', $lastStepNumber + 1)
            ->first();

            //if completed schedule
            if (!$nextStep) {
                $nextStep = 1;
                $nextSchedule = 9;
            }

            $day_gap = request('lead.step.day_gap') ? request('lead.step.day_gap') : 1;
            // dd(request('lead.due_date'));
            $nextDueDate = date('Y-m-d', strtotime(request('lead.due_date') . " +{$day_gap} day"));
            $nextStatus = 'prospecting';
        }

        // dd($nextSchedule, $nextStep, $nextDueDate, $nextStatus, $previousStepNumber, $previousScheduleId);
        // dd(request('lead')['campaign_id'], request('lead')['account_id'], request('lead.lead')['id']);
        // dd($activityHistory->leadAccount);
        $activityHistory->leadAccount()->updateOrCreate([
            'lead_id' => request('lead.lead')['id'],
            'account_id' => request('lead')['account_id'],
            'campaign_id' => request('lead')['campaign_id'],
            'schedule_id' => $nextSchedule,
            'step_id' => $nextStep,
            'due_date' => $nextDueDate,
            'current_status' => $nextStatus,
            'previous_step_number' => $previousStepNumber,
            'previous_schedule_id' => $previousScheduleId,
        ]);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

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

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
