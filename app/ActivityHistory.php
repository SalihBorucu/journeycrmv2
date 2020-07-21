<?php

namespace App;

use App\User;
use App\Account;
use App\Outcome;
use App\LeadAccount;
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
        $nextSchedule = $outcome->new_schedule_id ? $outcome->new_schedule_id :  request('lead.schedule_id');
        $previousScheduleId = request('lead.schedule_id');
        $previousStepNumber = request('lead.step.step_number');

        if ($outcome->new_schedule_id) {
            $nextStep = Steps::where('schedule_id', $outcome->new_schedule_id)
                ->where('step_number', 1)
                ->first();
            $nextDueDate = request('lead.due_date');
            $nextStatus = $outcome->name;

            //if new schedule is custom
            if (request('outcome') === "3") {
                $nextDueDate = request('custom_activity_date');
                $nextStep = Steps::where('schedule_id', $outcome->new_schedule_id)
                    ->where('step_number', request('custom_activity_type'))
                    ->first();
            }
        } else {
            $lastSchedule = request('lead.schedule_id');
            $lastStepNumber = request('lead.step.step_number');

            //custom previous schedule
            if (request('lead.schedule_id') === 8) {
                $lastSchedule = request('lead.previous_schedule_id');
                $lastStepNumber = request('lead.previous_step_number');
            }

            $nextStep = Steps::where('schedule_id', $lastSchedule)
                ->where('step_number', $lastStepNumber + 1)
                ->first();

            //if completed schedule
            if (!$nextStep) {
                $nextStep = 1;
                $nextSchedule = 9;
            }

            $day_gap = request('lead.step.day_gap');
            $nextDueDate = date('Y-m-d', strtotime(request('lead.due_date') . " +{$day_gap} day"));
            $nextStatus = 'prospecting';
        }

        $activityHistory->leadAccount()->updateOrCreate([
            'lead_id' => request('lead')['id'],
            'account_id' => request('lead')['account_id'],
            'campaign_id' => request('lead')['campaign_id'],
            'schedule_id' => $nextSchedule,
            'step_id' => $nextStep->id,
            'due_date' => $nextDueDate,
            'current_status' => $nextStatus,
            'previous_step_number' => $previousStepNumber,
            'previous_schedule_id' => $previousScheduleId,
        ]);
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
}
