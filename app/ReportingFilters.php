<?php

namespace App;

use App\QueryFilter;

class ReportingFilters extends QueryFilter
{
    public function account($id){
        return $this->builder->where('account_id', $id);
    }

    public function campaign($id)
    {
        return $this->builder->whereHas('leadAccount', function ($query) use ($id) {
            return $query->where('campaign_id', $id);
        });
    }

    public function reportType($reportType){
        $query = $this->builder;

        return $this->selectType($reportType, $query);
    }

    protected function selectType($reportType, $query){
        switch ($reportType) {
            case 'userActivities':
                $id = 'user_id';
                $field = 'type';
                break;

            case 'accountActivities':
                $id = 'account_id';
                $field = 'type';
                break;

            case 'userResults':
                $id = 'user_id';
                $field = 'outcome_id';
                break;

            case 'accountResults':
                $id = 'account_id';
                $field = 'outcome_id';
                break;
        }
        return $query->selectRaw('count(*) AS cnt,' . $id . ',' . $field)->groupBy($id, $field);
    }
}
