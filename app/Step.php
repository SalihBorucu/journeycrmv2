<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function templates(){
        return $this->hasMany(StepTemplate::class);
    }
}
