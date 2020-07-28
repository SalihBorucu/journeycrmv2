<?php

namespace App;

use App\QueryFilter;

class AllFilters extends QueryFilter
{
    public function account($id)
    {
        return $this->builder->where('account_id', $id);
    }

    public function campaign($id)
    {
        return $this->builder->whereHas('leadAccount', function ($query) use ($id) {
            return $query->where('campaign_id', $id);
        });
    }

    public function reportType($reportType)
    {
        $query = $this->builder;

        return $this->selectType($reportType, $query);
    }

    protected function selectType($reportType, $query)
    {
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

    public function company($id){
        return $this->builder->where('company_id', $id);
    }

    public function country($name){
        return $this->builder->where('country', $name);
    }

    public function first_name($name)
    {
        return $this->builder->where('first_name', 'like', $name.'%');
    }

    public function last_name($name)
    {
        return $this->builder->where('last_name', 'like', $name . '%');
    }

    public function title($title)
    {
        return $this->builder->where('title', 'like', $title . '%');
    }
}
