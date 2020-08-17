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

        switch ($nextSchedule) {
            case 5:
                $nextStatus = 'dnc';
                break;
            case 4:
                $nextStatus = 'interested';
                break;
            case 3:
                $nextStatus = 'qualified';
                break;

            default:
                $nextStatus = request('lead.current_status');
                break;
        }

        if ($outcome->new_schedule_id) {
            //If new schedule is custom
            if (request('outcome') === "3") {
                $nextDueDate = request('custom_activity_date');
                $nextStep = Step::where('schedule_id', $nextSchedule)
                    ->where('type', request('custom_activity_type'))
                    ->first();
                $nextStep = $nextStep ? $nextStep->id : null;
                //If this is the second run of a custom activity
                if (request('lead.schedule_id') === 6) {
                    $previousScheduleId = request('lead.previous_step_number');
                    $previousStepNumber = request('lead.previous_schedule_id');
                }
            } else {
                //All other new schedules
                $campaignScheduleId = CampaignSchedule::where([['schedule_id', $nextSchedule], ['campaign_id', request('lead.campaign_id')]])->first();
                $campaignScheduleId = $campaignScheduleId ? $campaignScheduleId->id : null;
                $nextStep = Step::where('campaign_schedule_id', $campaignScheduleId)
                    ->where('step_number', 1)
                    ->first()->id;
                $nextDueDate = date('Y-m-d', strtotime(request('lead.due_date') . " +1 day"));
            }
        } else {
            //When previous activity was custom but current one is not
            if (request('lead.schedule_id') === 6) {
                $campaignScheduleId = CampaignSchedule::where([['schedule_id', request('lead.previous_schedule_id')], ['campaign_id', request('lead.campaign_id')]])->first()->id;
                $nextStep = Step::where('campaign_schedule_id', $campaignScheduleId)
                    ->where('step_number', request('lead.previous_step_number') + 1)
                    ->first();
                $nextStep = $nextStep ? $nextStep->id : null;
                $nextSchedule = request('lead.previous_schedule_id');
            } else {
                //This is the standard flow
                $campaignScheduleId = CampaignSchedule::where([['schedule_id', request('lead.schedule_id')], ['campaign_id', request('lead.campaign_id')]])->first()->id;
                $nextStep = Step::where('campaign_schedule_id', $campaignScheduleId)
                    ->where('step_number', request('lead.step.step_number') + 1)
                    ->first();
                $nextStep = $nextStep ? $nextStep->id : null;
            }
            //If there are no more steps in schedule.
            if (!$nextStep) {
                $nextStep = 1;
                $nextSchedule = 7;
            }

            $day_gap = request('lead.step.day_gap', 1);
            $nextDueDate = date('Y-m-d', strtotime(request('lead.due_date') . " +{$day_gap} day"));
        }

        $activityHistory->leadAccount()->updateOrCreate(
            ['id' => request('lead.id')],
            [
                'lead_id' => request('lead.lead')['id'],
                'account_id' => request('lead')['account_id'],
                'campaign_id' => request('lead')['campaign_id'],
                'schedule_id' => $nextSchedule,
                'step_id' => $nextStep,
                'due_date' => $nextDueDate,
                'current_status' => $nextStatus,
                'previous_step_number' => $previousStepNumber,
                'previous_schedule_id' => $previousScheduleId,
            ]
        );
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
