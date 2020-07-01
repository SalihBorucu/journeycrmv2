<?php

namespace App;

use App\Outcome;
use Illuminate\Database\Eloquent\Model;

class ActivityHistory extends Model
{
    protected $guarded = [];

    public function outcome(){
        return $this->belongsTo(Outcome::class);
    }
}
