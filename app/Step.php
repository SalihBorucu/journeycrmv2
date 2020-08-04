<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $guarded = [];

    public function template(){
        return $this->hasOne(StepTemplate::class);
    }
}
