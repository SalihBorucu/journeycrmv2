<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded= [];

    public function steps()
    {
        return $this->hasMany(Steps::class);
    }
}


//schedule hasOne-> steps
/*
Outbound - Standard
step 1 => type: email, day_gap: 0, email_template_id: 1
step 2 => type: social, day_gap: 0, social_template_id: 1
step 3 => type: call, day_gap: 1
step 4 => type: email, day_gap: 2, email_template_id: 2
step 5 => type: call, day_gap: 1
step 6 => type: call, day_gap: 1
step 7 => type: email, day_gap: 1, email_template_id: 3
step 10 => type: call, day_gap: 2

Inbound - Standard
step 1 => type: email, day_gap: 0, email_template_id: 5
step 2 => type: social, day_gap: 0, social_template_id: 1
step 3 => type: call, day_gap: 1
step 4 => type: email, day_gap: 2, email_template_id: 6
step 5 => type: call, day_gap: 1
