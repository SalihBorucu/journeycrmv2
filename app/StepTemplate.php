<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StepTemplate extends Model
{
    public function step(){
        return $this->belongsTo(Step::class);
    }
}
